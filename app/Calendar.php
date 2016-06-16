<?php
namespace App;

use Carbon\Carbon;
use Google_Service_Calendar_Event;
use Illuminate\Support\Collection;
use Spatie\GoogleCalendar\Event;

class Calendar extends Event
{
    /* Overwrite Google Calendar sort events descending    */
    public static function get(
        Carbon $startDateTime = null,
        Carbon $endDateTime = null,
        array $queryParameters = [],
        string $calendarId = null
    ): Collection {
        $googleCalendar = static::getGoogleCalendar($calendarId);

        $googleEvents = $googleCalendar->listEvents($startDateTime, $endDateTime, $queryParameters);

        return collect($googleEvents)
            ->map(function (Google_Service_Calendar_Event $event) use ($calendarId) {
                return Event::createFromGoogleCalendarEvent($event, $calendarId);
            })
            ->sortByDesc(function (Event $event) {
                return $event->sortDate;
            })
            ->values();
    }
}