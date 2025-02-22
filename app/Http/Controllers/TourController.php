<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Inertia\Inertia;
use Inertia\Response;

class TourController extends Controller
{
    public function index(): Response
    {
        $tours = Tour::query()->with('events')->whereHas('events', function ($query) {
            $query->where('date_time', '>', now());
        })->orderBy('slider_order')->get();

        $pastTours = Tour::query()->whereDoesntHave('events', function ($query) {
            $query->where('date_time', '>=', now());
        })->get();

        return Inertia::render('Home', ['tours' => $tours, 'pastTours' => $pastTours]);
    }

    public function show(Tour $tour): Response
    {
        return Inertia::render('Events/Event', [
            'tour' => $tour->load('events'),
        ]);
    }
}
