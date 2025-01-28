<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Inertia\Inertia;

class EventController extends Controller
{


    public function index()
    {
        $events = Event::with('media')
            ->latest()
            ->paginate(10)
            ->through(fn($event) => [
                'id' => $event->id,
                'title' => $event->title,
                'start_date' => $event->start_date->format('Y-m-d H:i'),
                'end_date' => $event->end_date->format('Y-m-d H:i'),
                'location' => $event->location,
                'venue' => $event->venue,
                'status' => $event->status,
                'poster' => $event->getFirstMediaUrl('event_poster'),
            ]);

        return Inertia::render('Events/Index', [
            'events' => $events,
        ]);
    }
}
