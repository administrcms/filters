<?php

namespace Administr\ListView\Filters\Types;

use Administr\Form\Field\RadioGroup;

class Boolean extends Type
{
    public function formField()
    {
        return new RadioGroup($this->field(), $this->label(), function (RadioGroup $group) {
            $group
                ->checkbox('да', ['value' => 1])
                ->checkbox('не', ['value' => 0])
                ;
        });
    }

    public function value()
    {
        return (bool)parent::value();
    }
}