<?php

namespace Administr\ListView\Filters\Types;

use Administr\Form\FormBuilder;

class TimeBetween extends DateBetween
{
    public function formField()
    {
        return (new Group($this->field(), $this->label(), function(FormBuilder $builder) {
            $builder->time("{$this->field()}_start", 'Начален час')
                ->time("{$this->field()}_end", 'Краен час');
        }))
            ->setView('administr.listview-filters::filters');
    }

    public function value()
    {
        $start = "{$this->field}_start";
        $end = "{$this->field}_end";

        return [
            Carbon::parse($this->getFromRequest($start)),
            Carbon::parse($this->getFromRequest($end)),
        ];
    }
}