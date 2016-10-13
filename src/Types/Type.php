<?php

namespace Administr\Filters\Types;

use Administr\Form\Field\AbstractType;

abstract class Type
{
    protected $field;
    protected $label;
    protected $options;

    public function __construct($field, $label, $options = null)
    {
        $this->field = $field;
        $this->label = $label;
        $this->options = $options;
    }

    /**
     * Get/Set field
     *
     * @param null $field
     * @return mixed
     */
    public function field($field = null)
    {
        if(is_null($field)) {
            return $this->field;
        }

        $this->field = $field;
    }

    public function label($label = null)
    {
        if(is_null($label)) {
            return $this->label;
        }

        $this->label = $label;
    }

    public function options($options = null)
    {
        if(is_null($options)) {
            return $this->options;
        }

        $this->options = $options;
    }

    public function value()
    {
        return $this->getFromRequest($this->field);
    }

    protected function getFromRequest($field)
    {
        return request("filters.{$field}");
    }

    /**
     * @return AbstractType
     */
    abstract public function formField();
}