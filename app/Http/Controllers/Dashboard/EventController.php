<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Event\EventCreateRequest;
use App\Models\Event;
use App\Services\EventService;
use Inertia\Inertia;

class EventController
{
    protected EventService $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index()
    {
        return Inertia::render('Events/Index', [
            'events' => Event::all(),
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

    public function show(Event $event)
    {
        dd($event);
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
