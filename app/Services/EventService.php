<?php

namespace App\Services;

use App\Models\Event;

class EventService
{
    public function store(array $attributes): void
    {
        $event = Event::create($attributes);

        $event->addMedia($attributes['banner'])
            ->toMediaCollection('event_banner');
    }
}
