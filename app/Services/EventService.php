<?php

namespace App\Services;

use App\Models\Tour;
use Illuminate\Support\Facades\DB;

class EventService
{
    public function store(array $attributes): void
    {
        DB::transaction(function () use ($attributes) {
            $tour = auth()->user()->tours()->create($attributes);

            if (request()->hasFile('banner_file')) {
                $tour->addMedia($attributes['banner_file'])
                    ->toMediaCollection('banner_file');
            }

            foreach ($attributes['events'] as $eventData) {
                $event = $tour->events()->create($eventData);

                if (isset($eventData['tickets'])) {
                    foreach ($eventData['tickets'] as $ticketData) {
                        $event->tickets()->create($ticketData);
                    }
                }
            }
        });
    }

    public function update(Tour $tour, array $attributes): void
    {
        DB::transaction(function () use ($tour, $attributes) {
            $tour->update($attributes);

            if (isset($attributes['banner_file'])) {
                $tour->clearMediaCollection('banner_file');
                $tour->addMedia($attributes['banner_file'])->toMediaCollection('banner_file');
            }

            if (isset($attributes['events'])) {
                foreach ($attributes['events'] as $eventData) {
                    if (!empty($eventData['id'])) {
                        $event = $tour->events()->find($eventData['id']);
                        if ($event) {
                            $event->update($eventData);
                        } else {
                            $event = $tour->events()->create($eventData);
                        }
                    } else {
                        $event = $tour->events()->create($eventData);
                    }
                    if (isset($eventData['tickets'])) {
                        $event->tickets()->delete();

                        foreach ($eventData['tickets'] as $ticketData) {
                            $event->tickets()->create($ticketData);
                        }
                    }
                }
            }
        });
    }

    public function destroy(Tour $tour): void
    {
        $tour->clearMediaCollection('preview');

        $tour->delete();
    }
}
