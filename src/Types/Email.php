<?php

namespace Administr\Filters\Types;

use Administr\Form\Field\Email as EmailField;

class Email extends Type
{
    public function formField()
    {
        return new EmailField($this->field(), $this->label(), $this->options());
    }
}