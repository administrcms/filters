<?php

namespace Administr\ListView\Filters;

use Administr\Form\Field\Group;
use Administr\ListView\Filters\Types\Type;

/**
 * @method ListViewFilters text($field)
 * @method ListViewFilters date($field)
 * @method ListViewFilters time($field)
 * @method ListViewFilters datetime($field)
 * @method ListViewFilters dateBetween($field)
 * @method ListViewFilters timeBetween($field)
 * @method ListViewFilters boolean($field)
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
        return (new Group('', '', function(Group $group) {
            foreach($this->filters as $filter) {
                $group->builder()->add($filter->formField());
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