<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Tour;

class EventService
{
    public function store(array $attributes): void
    {
        $tour = auth()->user()->tours()->create($attributes);

        foreach ($attributes['events'] as $index => $eventAttributes) {
            $event = $tour->events()->create($attributes['events'][$index]);

            if (isset($eventAttributes['tickets'])) {
                $event->tickets()->createMany($eventAttributes['tickets']);
            }
        }

        if (request()->hasFile('poster')) {
            $tour->addMedia($attributes['poster'])
                ->toMediaCollection('poster');
        }
    }

    public function update(Tour $tour, array $attributes): void
    {
        $tour->update($attributes);


        foreach ($attributes['events'] as $index => $eventAttributes) {
            $eventAttributes = array_filter($eventAttributes, function ($key) {
                return $key !== 'tickets';
            }, ARRAY_FILTER_USE_KEY);
            $tour->events()->where('id', $eventAttributes['id'])->update($eventAttributes);
            if (isset($eventAttributes['tickets'])) {
                $tourEvent = $tour->events()->find($eventAttributes['id']);
                $tourEvent->tickets()->delete();
                $tourEvent->tickets()->createMany($eventAttributes['tickets']);
            }
        }


        if (isset($attributes['poster'])) {
            $tour->clearMediaCollection('poster');
            $tour->addMedia($attributes['poster'])
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
