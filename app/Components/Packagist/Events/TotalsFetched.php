<?php

namespace App\Components\Packagist\Events;

use App\Components\DashboardEvent;

class TotalsFetched extends DashboardEvent
{
    public $tickets;
    public $friday;
    public $saturday;
    public $door;
    public $food;

    public function __construct($totals)
    {
        foreach ($totals as $sumName => $total) {
            $this->$sumName = (int) $total;
        }
    }
}
