<?php

namespace Administr\Filters\Types;

use Administr\Form\Field\Text as TextField;

class Text extends Type
{
    public function formField()
    {
        return new TextField($this->field(), $this->label(), $this->options());
    }
}