<?php

namespace Administr\ListView\Filters\Types;

use Carbon\Carbon;

class DateTime extends Type
{
    public function formField()
    {
        // TODO return AbstractType
    }

    public function value()
    {
        return Carbon::parse(parent::value());
    }
}