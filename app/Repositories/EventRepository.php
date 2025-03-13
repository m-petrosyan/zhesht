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
}
