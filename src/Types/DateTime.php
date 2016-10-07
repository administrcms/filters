<?php

namespace Administr\ListView\Filters\Types;

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
        return Carbon::parse(parent::value());
    }
}