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
            'Client/Home',
            [
                'upcomingTours' => $upcomingTours,
                'pastTours' => $pastTours,
                'sliderTours' => $sliderTours,
            ]
        );
    }

    public function past()
    {
        $pastTours = TourRepository::getPastToursByYears();


        return Inertia::render('Client/PastList', [
            'pastTours' => $pastTours,
        ]);
    }

    public function show(Tour $tour): Response
    {
        return Inertia::render('Client/EventList', [
            'tour' => $tour->load('events'),
        ]);
    }
}
