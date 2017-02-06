<?php

namespace Administr\Filters\Types;

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
            ->setView('administr/filters::between');
    }

    public function value()
    {
        $start = $this->getFromRequest("{$this->field()}_start");
        $end = $this->getFromRequest("{$this->field()}_end");

        if(strlen($start) === 0 || strlen($end) === 0) {
            return null;
        }

        return [
            $start,
            $end
        ];
    }
}