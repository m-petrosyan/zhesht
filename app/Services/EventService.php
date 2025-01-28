<?php

namespace App\Services;

use App\Models\Event;

class EventService
{
    public function store(array $attributes): void
    {
        $event = auth()->user()->events()->create($attributes);

        if (isset($attributes['tickets'])) {
            $event->tickets()->createMany($attributes['tickets']);
        }

        if (request()->hasFile('poster')) {
            $event->addMedia($attributes['poster'])
                ->toMediaCollection('poster');
        }
    }

    public function update(Event $event, array $attributes): void
    {
        $event->update($attributes);

        if (isset($attributes['tickets'])) {
            $event->tickets()->delete();
            $event->tickets()->createMany($attributes['tickets']);
        }

        if (isset($attributes['poster'])) {
            $event->clearMediaCollection('poster');
            $event->addMedia($attributes['poster'])
                ->toMediaCollection('poster');
        }
    }

    public function destroy(Event $event): void
    {
//        $event->getFirstMedia('preview')?->delete();
        $event->clearMediaCollection('preview');

        $event->delete();
    }
}
