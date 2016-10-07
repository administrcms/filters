<?php

namespace Administr\ListView\Filters\Types;

class TimeBetween extends DateBetween
{
    public function formField()
    {
        return new Group($this->field(), $this->label(), function(Group $group) {
            $group->time("{$this->field()}_start", 'Начален час');
            $group->time("{$this->field()}_end", 'Краен час');
        });
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