<?php

namespace App\Services;

class EventService
{
    public function store(array $attributes): void
    {
        $event = auth()->user()->events()->create($attributes);


        $event->tickets()->createMany($attributes['tickets']);

        $event->addMedia($attributes['banner'])
            ->toMediaCollection('banner');
    }
}
