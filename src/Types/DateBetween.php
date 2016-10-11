<?php

namespace Administr\ListView\Filters\Types;

use Administr\Form\Field\Group;
use Administr\Form\FormBuilder;
use Carbon\Carbon;

class DateBetween extends Type
{
    public function formField()
    {
        return (new Group($this->field(), $this->label(), function(FormBuilder $builder) {
            $builder
                ->date("{$this->field()}_start", 'Начална дата')
                ->date("{$this->field()}_end", 'Крайна дата');
        }))
            ->setView('administr/listview-filters::between');;
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