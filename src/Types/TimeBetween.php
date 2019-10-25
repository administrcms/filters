<?php

namespace Administr\Filters\Types;

use Administr\Form\Field\Group;
use Administr\Form\FormBuilder;
use Illuminate\Support\Arr;

class TimeBetween extends DateBetween
{
    public function formField()
    {
        return (new Group($this->field(), $this->label(), function(FormBuilder $builder) {
            $start = Arr::get($this->options(), 'start', ['placeholder' => 'Start time']);
            $end = Arr::get($this->options(), 'end', ['placeholder' => 'End time']);

            $builder
                ->time("{$this->field()}_start", '', $start)
                ->time("{$this->field()}_end", '', $end);
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