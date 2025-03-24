<?php

namespace App\Repositories;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class EventRepository
{
    public static function getPastEventsByYears(): array|Collection
    {
        return Event::query()->with('tour')->orderByDesc('date_time')->get()->groupBy(
            fn($event) => Carbon::parse($event->date_time)->format('Y')
        );
    }

    public static function getPastEvents(): array|Collection
    {
        return Event::query()->with('tour')->where('date_time', '<', now())->orderByDesc('date_time')->get();
    }
}
