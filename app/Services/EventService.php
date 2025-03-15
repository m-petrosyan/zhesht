<?php

namespace App\Services;

use App\Models\Event;

class EventService
{
    public function destroy(Event $event): void
    {
        $event->clearMediaCollection('preview');

        $event->delete();
    }
}
