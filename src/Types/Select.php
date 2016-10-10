<?php

namespace Administr\ListView\Filters\Types;

use Administr\Form\Field\Select as SelectField;

class Select extends Type
{
    public function formField()
    {
        return new SelectField($this->field(), $this->label(), $this->options());
    }
}