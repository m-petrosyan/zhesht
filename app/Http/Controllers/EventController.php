<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\EventCreateRequest;
use App\Models\Event;
use App\Services\EventService;
use Inertia\Inertia;

class EventController extends Controller
{
    protected EventService $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index()
    {
        dd(1);
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
                'banner' => $event->getFirstMediaUrl('event_banner'),
            ]);

        return Inertia::render('Events/Index', [
            'events' => $events,
        ]);
    }

    public function create()
    {
        return Inertia::render('Events/Create');
    }

    public function store(EventCreateRequest $request)
    {
        $this->eventService->store($request->validated());

        return redirect()->route('events.index')
            ->with('success', 'Event created successfully!');
    }

    public function edit(Event $event)
    {
        return Inertia::render('Events/Edit', [
            'event' => [
                'id' => $event->id,
                'title' => $event->title,
                'content' => $event->content,
                'start_date' => $event->start_date->format('Y-m-d\TH:i'),
                'end_date' => $event->end_date->format('Y-m-d\TH:i'),
                'location' => $event->location,
                'venue' => $event->venue,
                'max_participants' => $event->max_participants,
                'status' => $event->status,
                'banner' => $event->getFirstMediaUrl('event_banner'),
                'images' => $event->getMedia('event_images')->map->toArray(),
            ],
        ]);
    }

}
