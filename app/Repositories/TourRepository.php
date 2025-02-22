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
            ->addSelect([
                'nearest_event' => Event::query()->select('date_time')
                    ->whereColumn('tour_id', 'tours.id')
                    ->where('date_time', '>', now())
                    ->orderBy('date_time', 'asc')
                    ->limit(1),
            ])
            ->orderBy('nearest_event', 'asc')
            ->get();
    }

    public static function getPastTours(): Collection
    {
        return Tour::query()->whereDoesntHave('events', function ($query) {
            $query->where('date_time', '>=', now());
        })->get();
    }

    public static function getSliderTours(): Collection
    {
        return Tour::query()->with('events')->whereHas('events', function ($query) {
            $query->where('date_time', '>', now());
        })->orderBy('slider_order')->get();
    }

}
