<?php

namespace Administr\Filters\Types;

use Administr\Form\Field\Group;
use Administr\Form\FormBuilder;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class DateTimeBetween extends Type
{
    public function formField()
    {
        return (new Group($this->field(), $this->label(), function(FormBuilder $builder) {
            $start = Arr::get($this->options(), 'start', ['placeholder' => 'Start date/time']);
            $end = Arr::get($this->options(), 'end', ['placeholder' => 'End date/time']);

            $builder
                ->datetime("{$this->field()}_start", '', $start)
                ->datetime("{$this->field()}_end", '', $end);
        }))
            ->setView('administr/filters::between');
    }

    public function value()
    {
        $value = parent::value();

        if(strlen($value) === 0) {
            return null;
        }

        return Carbon::parse($value);
    }
}