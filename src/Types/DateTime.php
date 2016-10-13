<?php

namespace Administr\Filters\Types;

use Administr\Form\Field\DateTime as DateTimeField;
use Carbon\Carbon;

class DateTime extends Type
{
    public function formField()
    {
        return new DateTimeField($this->field(), $this->label(), $this->options());
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