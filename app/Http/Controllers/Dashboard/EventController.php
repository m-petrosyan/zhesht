<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Event\EventCreateRequest;
use App\Http\Requests\Event\EventUpdateRequest;
use App\Models\Tour;
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
            'tours' => Tour::with('events')->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Dashboard/Events/CreateEdit');
    }

    public function store(EventCreateRequest $request): RedirectResponse
    {
        $this->eventService->store($request->validated());

        return redirect()->route('db.event.index')
            ->with('success', 'Event created successfully!');
    }


    public function edit(Tour $tour): Response
    {
        return Inertia::render('Dashboard/Events/CreateEdit', [
            'tour' => [
                'id' => $tour->id,
                'title' => $tour->title,
                'content' => $tour->content,
                'banner' => $tour->banner_file,
                'poster' => $tour->poster_file,
                'images' => $tour->getMedia('event_images')->map->toArray(),
                'events' => $tour->events->map->toArray(),
            ],
        ]);
    }

    public function update(EventUpdateRequest $request, Tour $tour): RedirectResponse
    {
        $this->eventService->update($tour, $request->validated());

        return redirect()->route('db.event.index');
    }

    public function destroy(Tour $tour): void
    {
        $this->eventService->destroy($tour);
    }
}
