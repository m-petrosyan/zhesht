<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Event\EventCreateRequest;
use App\Http\Requests\Event\EventUpdateRequest;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class EventController
{
    protected EventService $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index()
    {
        return Inertia::render('Dashboard/Events/Index', [
            'events' => Event::all(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Dashboard/Events/CreateEdit');
    }

    public function store(EventCreateRequest $request): RedirectResponse
    {
        dd($request->validated());
        $this->eventService->store($request->validated());

        return redirect()->route('db.event.index')
            ->with('success', 'Event created successfully!');
    }


    public function edit(Event $event): Response
    {
        return Inertia::render('Dashboard/Events/CreateEdit', [
            'event' => [
                'id' => $event->id,
                'title' => $event->title,
                'content' => $event->content,
                'date_time' => \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->date_time)->format('Y-m-d\TH:i'),
                'location' => $event->location,
                'status' => $event->status,
                'banner' => $event->poster,
                'tickets' => $event->tickets,
                'images' => $event->getMedia('event_images')->map->toArray(),
            ],
        ]);
    }

    public function update(EventUpdateRequest $request, Event $event): RedirectResponse
    {
        $this->eventService->update($event, $request->validated());

        return redirect()->route('db.event.index');
    }

    public function destroy(Event $event): void
    {
        $this->eventService->destroy($event);
    }
}
