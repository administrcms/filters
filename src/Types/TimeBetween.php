<?php

namespace Administr\ListView\Filters\Types;

use Administr\Form\Field\Group;
use Administr\Form\FormBuilder;

class TimeBetween extends DateBetween
{
    public function formField()
    {
        return (new Group($this->field(), $this->label(), function(FormBuilder $builder) {
            $builder
                ->time("{$this->field()}_start", '', ['placeholder' => 'Начален час'])
                ->time("{$this->field()}_end", '', ['placeholder' => 'Краен час']);
        }))
            ->setView('administr/listview-filters::between');
    }
}