<?php

namespace App\Components\Notification\Events;

use App\Components\DashboardEvent;

class NotificationFetched extends DashboardEvent
{
    public $grid;
    public $title;
    public $message;

    public function __construct($grid, $title, $message)
    {
        $this->grid = $grid;
        $this->title = $title;
        $this->message = $message;
    }
}
