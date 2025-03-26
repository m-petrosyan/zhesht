<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Repositories\TourRepository;
use Inertia\Inertia;
use Inertia\Response;

class TourController extends Controller
{
    public function index(): Response
    {
        $upcomingTours = TourRepository::getUpcomingTours();
        $sliderTours = TourRepository::getSliderTours();

        return Inertia::render(
            'Client/Home',
            [
                'upcomingTours' => $upcomingTours,
                'sliderTours' => $sliderTours,
            ]
        );
    }

    public function show(Tour $tour): Response
    {
        return Inertia::render('Client/Event', [
            'tour' => $tour->load('events'),
        ]);
    }
}
