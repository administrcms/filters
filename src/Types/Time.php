<?php

namespace Administr\ListView\Filters\Types;

use Administr\Form\Field\AbstractType;
use Administr\Form\Field\Time as TimeField;
use Carbon\Carbon;

class Time extends Type
{
    /**
     * @return AbstractType
     */
    public function formField()
    {
        return new TimeField($this->field(), $this->label(), $this->options());
    }

    public function value()
    {
        return Carbon::parse(parent::value());
    }
}