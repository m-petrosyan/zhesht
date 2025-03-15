<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Event;
use App\Services\EventService;

class EventController
{
    private EventService $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function destroy(Event $event)
    {
        $this->eventService->destroy($event);
    }
}
