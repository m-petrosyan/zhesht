<?php

namespace App\Repositories;

use App\Models\Tour;
use Carbon\Carbon;
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

    public static function getPastToursByYears(): Collection
    {
        return Tour::query()->with([
            'events' => function ($query) {
                $query->orderBy('date_time', 'desc');
            },
        ])->get()->groupBy(fn($tour) => Carbon::parse($tour->events->first()->date_time)->format('Y'));
    }

    public static function getSliderTours(): Collection
    {
        return Tour::query()->with('events')->whereHas('events', function ($query) {
            $query->where('date_time', '>', now());
        })->orderBy('slider_order')->get();
    }

}
