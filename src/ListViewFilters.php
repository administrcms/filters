<?php

namespace Administr\ListView\Filters;

use Administr\Form\Field\Group;
use Administr\Form\FormBuilder;
use Administr\ListView\Filters\Types\Type;

/**
 * @method ListViewFilters text($name, $label, $options = null)
 * @method ListViewFilters date($name, $label, $options = null)
 * @method ListViewFilters time($name, $label, $options = null)
 * @method ListViewFilters datetime($name, $label, $options = null)
 * @method ListViewFilters dateBetween($name, $label, $options = null)
 * @method ListViewFilters timeBetween($name, $label, $options = null)
 * @method ListViewFilters boolean($name, $label, $options = null)
 */
class ListViewFilters
{
    protected $filters = [];

    public function getData()
    {
        $filters = [];

        foreach($this->filters as $field => $filter)
        {
            $filters[$field] = $filter->value();
        }

        return $filters;
    }

    /**
     * @return string
     */
    public function render()
    {
        return (new Group('', '', function(FormBuilder $builder) {
            foreach($this->filters as $filter) {
                $builder->add($filter->formField());
            }
        }))
            ->setView('administr.listview-filters::filters')
            ->render();
    }

    /**
     * @param Type $filter
     * @return $this
     */
    public function add(Type $filter)
    {
        $this->filters[$filter->field()] = $filter;
        return $this;
    }

    public function __call($name, $args = [])
    {
        $class = '\Administr\ListView\Filters\Types\\' . studly_case($name);

        if(!class_exists($class)) {
            $class = '\Administr\ListView\Filters\Types\Text';
        }

        if(count($args) === 2)
        {
            $args[] = [];
        }

        return $this->add(app($class, $args));
    }
}