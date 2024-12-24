<?php

namespace App\Services;

class EventService
{
    public function store(array $attributes): void
    {
        $event = auth()->user()->events()->create($attributes);


        $event->addMedia($attributes['banner'])
            ->toMediaCollection('event_banner');
    }
}
