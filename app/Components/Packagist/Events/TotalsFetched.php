<?php

namespace App\Components\Packagist\Events;

use App\Components\DashboardEvent;

class TotalsFetched extends DashboardEvent
{
    public $daily;
    
    public $total;

    public $sold;

    public function __construct($totals)
    {
        foreach ($totals as $sumName => $total) {
            $this->$sumName = $total;
        }
    }
}
