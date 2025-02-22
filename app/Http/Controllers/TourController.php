<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tour;
use Inertia\Inertia;
use Inertia\Response;

class TourController extends Controller
{
    public function index(): Response
    {
        $sliderTours = Tour::query()->with('events')->whereHas('events', function ($query) {
            $query->where('date_time', '>', now());
        })->orderBy('slider_order')->get();

        $upcomingTours = Tour::query()
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


        $pastTours = Tour::query()->whereDoesntHave('events', function ($query) {
            $query->where('date_time', '>=', now());
        })->get();

        return Inertia::render(
            'Home',
            [
                'upcomingTours' => $upcomingTours,
                'pastTours' => $pastTours,
                'sliderTours' => $sliderTours,
            ]
        );
    }

    public function show(Tour $tour): Response
    {
        return Inertia::render('Events/Event', [
            'tour' => $tour->load('events'),
        ]);
    }
}
