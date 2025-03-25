<?php

namespace App\Http\Controllers;

use App\Repositories\EventRepository;
use Inertia\Inertia;

class EventController
{
    public function past()
    {
        $pastTours = EventRepository::getPastEventsByYears();
      
        return Inertia::render('Client/PastList', [
            'pastTours' => $pastTours,
        ]);
    }
}
