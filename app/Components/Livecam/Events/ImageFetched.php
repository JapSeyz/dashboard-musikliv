<?php

namespace App\Components\Livecam\Events;

use App\Components\DashboardEvent;

class ImageFetched extends DashboardEvent
{
    public $path;
    
    public function __construct()
    {
        $this->path = asset('img/livecam.jpg').'?'.time();
    }
}
