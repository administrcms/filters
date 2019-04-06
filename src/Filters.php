<?php

namespace Administr\Filters;

use Administr\Form\Field\Group;
use Administr\Form\Field\Submit;
use Administr\Form\FormBuilder;
use Administr\Filters\Types\Type;

/**
 * @method Filters text($name, $label, $options = null)
 * @method Filters email($name, $label, $options = null)
 * @method Filters select($name, $label, $options = null)
 * @method Filters date($name, $label, $options = null)
 * @method Filters time($name, $label, $options = null)
 * @method Filters datetime($name, $label, $options = null)
 * @method Filters dateBetween($name, $label, $options = null)
 * @method Filters timeBetween($name, $label, $options = null)
 * @method Filters boolean($name, $label, $options = null)
 */
class Filters
{
    protected $filters = [];

    public function getData()
    {
        $filters = [];

        foreach ($this->filters as $field => $filter) {
            $filters[ $field ] = $filter->value();
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

        if (!$filterBtn = config('administr.filters.filterBtn') instanceof Submit) {
            $filterBtn = new Submit(
                config('administr.filters.filterBtn.name'),
                config('administr.filters.filterBtn.label'),
                config('administr.filters.filterBtn.options')
            );
        }

        $clearBtn = [
            'label' => config('administr.filters.clearBtn.label'),
            'url'   => $clearUrl,
        ];

        return (new Group('', '', function (FormBuilder $builder) {
            $builder->dataSource($this->getData());
            
            foreach ($this->filters as $filter) {
                $builder->add($filter->formField());
            }
        }))
            ->setView('administr/filters::filters')
            ->render([], [
                'filterBtn' => $filterBtn,
                'clearBtn'  => $clearBtn,
                'clearUrl'  => $clearUrl,
            ]);
    }

    /**
     * @param Type $filter
     * @return $this
     */
    public function add(Type $filter)
    {
        $this->filters[ $filter->field() ] = $filter;

        return $this;
    }

    public function __call($name, $args = [])
    {
        $class = '\Administr\Filters\Types\\' . studly_case($name);

        if (!class_exists($class)) {
            $class = '\Administr\Filters\Types\Text';
        }

        if (count($args) === 2) {
            $args[] = [];
        }

        return $this->add(app($class, [
            'field'   => $args[0],
            'label'   => $args[1],
            'options' => $args[2],
        ]));
    }
}