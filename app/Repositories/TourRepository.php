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
                    $query->orderBy('date_time', 'asc'); // Загружаем ивенты, отсортированные по дате
                },
            ])
            ->whereHas('events', function ($query) {
                $query->where('date_time', '>', now()); // Только туры с будущими ивентами
            })
            ->select('tours.*') // Выбираем все поля из таблицы tours
            ->addSelect([
                'earliest_event_date' => Event::select('date_time')
                    ->whereColumn('events.tour_id', 'tours.id')
                    ->orderBy('date_time', 'asc') // Берем ближайшую дату
                    ->limit(1)
            ])
            ->orderBy('earliest_event_date', 'asc') // Сортируем туры по ближайшей дате ивента
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
