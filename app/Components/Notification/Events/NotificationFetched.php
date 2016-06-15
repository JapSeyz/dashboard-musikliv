<?php

namespace App\Components\Notification\Events;

use App\Components\DashboardEvent;

class NotificationFetched extends DashboardEvent
{
    public $title;

    public $content;

    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = markdownToHtml($content);
    }
}
