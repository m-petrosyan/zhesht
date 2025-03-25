<?php

namespace App\Repositories;

use App\Models\Event;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Collection;

class TourRepository
{
    public static function getUpcomingTours(): Collection
    {
        return Tour::query()
            ->with([
                'events' => function ($query) {
                    $query->orderBy('date_time', 'asc');
                },
            ])
            ->whereHas('events', function ($query) {
                $query->where('date_time', '>', now());
            })
            ->select('tours.*')
            ->addSelect([
                'earliest_event_date' => Event::select('date_time')
                    ->whereColumn('events.tour_id', 'tours.id')
                    ->orderBy('date_time')
                    ->limit(1)
            ])
            ->orderBy('earliest_event_date')
            ->get();
    }

    public static function getPastTours(): Collection
    {
        return Tour::query()->with([
            'events' => function ($query) {
                $query->orderBy('date_time', 'asc');
            },
        ])->get();
    }

    public static function getSliderTours(): Collection
    {
        return Tour::query()->with('events')->whereHas('events', function ($query) {
            $query->where('date_time', '>', now());
        })->orderBy('slider_order')->get();
    }

}
