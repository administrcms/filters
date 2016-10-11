<?php

namespace Administr\ListView\Filters;

use Administr\Form\Field\Group;
use Administr\Form\Field\Submit;
use Administr\Form\FormBuilder;
use Administr\ListView\Filters\Types\Type;

/**
 * @method ListViewFilters text($name, $label, $options = null)
 * @method ListViewFilters email($name, $label, $options = null)
 * @method ListViewFilters select($name, $label, $options = null)
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
        if (count($this->filters) === 0) {
            return null;
        }

        $page = request()->has('page') ? '?page=' . request('page') : null;
        $clearUrl = url()->current() . $page;

        if (! $filterBtn = config('administr.listview-filters.filterBtn') instanceof Submit) {
            $filterBtn = new Submit(
                config('administr.listview-filters.filterBtn.name'),
                config('administr.listview-filters.filterBtn.label'),
                config('administr.listview-filters.filterBtn.options')
            );
        }

        $clearBtn = [
            'label' => config('administr.listview-filters.clearBtn.label'),
            'url' => $clearUrl,
        ];

        return (new Group('', '', function(FormBuilder $builder) {
            foreach($this->filters as $filter) {
                $builder->add($filter->formField());
            }
        }))
            ->setView('administr/listview-filters::filters')
            ->render([], [
                'filterBtn' => $filterBtn,
                'clearBtn' => $clearBtn,
                'clearUrl' => $clearUrl,
            ]);
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