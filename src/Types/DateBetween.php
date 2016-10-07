<?php

namespace Administr\ListView\Filters\Types;

use Administr\Form\Field\Group;
use Carbon\Carbon;

class DateBetween extends Type
{
    public function formField()
    {
        return new Group($this->field(), $this->label(), function(Group $group) {
            $group->date("{$this->field()}_start", 'Начална дата');
            $group->date("{$this->field()}_end", 'Крайна дата');
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