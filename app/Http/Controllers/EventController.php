<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Inertia\Inertia;
use Inertia\Response;

class EventController extends Controller
{


    public function index(): Response
    {
        $events = Event::query()->where('date_time', '>', now())->get();
        $pastEvents = Event::query()->where('date_time', '<', now())->get();

        return Inertia::render('Home', ['events' => $events, 'pastEvents' => $pastEvents]);
    }

    public function show(Event $event): Response
    {
        return Inertia::render('Events/Event', [
            'event' => $event,
        ]);
    }
}
