<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Repositories\EventRepository;
use App\Repositories\TourRepository;
use Inertia\Inertia;
use Inertia\Response;

class TourController extends Controller
{
    public function index(): Response
    {
        $upcomingTours = TourRepository::getUpcomingTours();
        $pastEvents = EventRepository::getPastEvents();
        $sliderTours = TourRepository::getSliderTours();

        return Inertia::render(
            'Client/Home',
            [
                'upcomingTours' => $upcomingTours,
                'pastEvents' => $pastEvents,
                'sliderTours' => $sliderTours,
            ]
        );
    }

//    public function past() //todo delete
//    {
//        $pastTours = TourRepository::getPastToursByYears();
//
//        return Inertia::render('Client/PastList', [
//            'pastTours' => $pastTours,
//        ]);
//    }

    public function show(Tour $tour): Response
    {
        return Inertia::render('Client/EventList', [
            'tour' => $tour->load('events'),
        ]);
    }
}
