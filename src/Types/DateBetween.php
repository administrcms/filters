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
                ->date("{$this->field()}_start", '', ['placeholder' => 'Начална дата'])
                ->date("{$this->field()}_end", '', ['placeholder' => 'Крайна дата']);
        }))
            ->setView('administr/listview-filters::between');;
    }

    public function value()
    {
        $start = $this->getFromRequest("{$this->field}_start");
        $end = $this->getFromRequest("{$this->field}_end");

        if(is_null($start) || is_null($end)) {
            return null;
        }

        return [
            Carbon::parse($start)->startOfDay(),
            Carbon::parse($end)->endOfDay(),
        ];
    }
}