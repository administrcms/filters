<?php

namespace Administr\ListView\Filters\Types;

use Administr\Form\Field\Date as DateField;
use Carbon\Carbon;

class Date extends Type
{
    public function formField()
    {
        return new DateField($this->field(), $this->label(), $this->options());
    }

    public function value()
    {
        $value = parent::value();

        if(is_null($value)) {
            return null;
        }

        return Carbon::parse($value);
    }
}