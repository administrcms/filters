<?php

namespace Administr\ListView\Filters\Types;

class Boolean extends Type
{
    public function formField()
    {
        // TODO return AbstractType
    }

    public function value()
    {
        return (bool)parent::value();
    }
}