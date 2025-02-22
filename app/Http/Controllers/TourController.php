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
        $pastTours = TourRepository::getPastTours();
        $sliderTours = TourRepository::getSliderTours();

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
