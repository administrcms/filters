<?php

namespace Administr\ListView\Filters\Types;

use Administr\Form\Field\AbstractType;
use Administr\Form\Field\Time as TimeField;

class Time extends Date
{
    /**
     * @return AbstractType
     */
    public function formField()
    {
        return new TimeField($this->field(), $this->label(), $this->options());
    }
}