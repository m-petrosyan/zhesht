<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Tour\TourCreateRequest;
use App\Http\Requests\Tour\TourReorderRequest;
use App\Http\Requests\Tour\TourUpdateRequest;
use App\Models\Tour;
use App\Services\TourService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class TourController
{
    protected TourService $tourService;

    public function __construct(TourService $tourService)
    {
        $this->tourService = $tourService;
    }

    public function index(): Response
    {
        $tours = Tour::with('events')->get()->groupBy(function ($tour) {
            $now = now();
            $hasPastEvents = $tour->events->every(fn($event) => $event->date_time < $now);

            return $hasPastEvents ? 'past' : 'active';
        });

        $activeTours = $tours->get('active', collect())->sortBy('slider_order')->values();

        return Inertia::render('Dashboard/Events/Index', [
            'past' => $tours->get('past', []),
            'active' => $activeTours,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Dashboard/Events/CreateEdit');
    }

    public function store(TourCreateRequest $request): RedirectResponse
    {
        $this->tourService->store($request->validated());

        return redirect()->route('db.event.index')
            ->with('success', 'Event created successfully!');
    }


    public function edit(Tour $tour): Response
    {
        return Inertia::render('Dashboard/Events/CreateEdit', [
            'tour' => $tour->load('events.galleries'),
        ]);
    }

    public function reorder(TourReorderRequest $request): void
    {
        $this->tourService->reorder($request->validated());
    }

    public function update(TourUpdateRequest $request, Tour $tour): RedirectResponse
    {
        $this->tourService->update($tour, $request->validated());

        return redirect()->route('db.event.index');
    }

    public function destroy(Tour $tour): void
    {
        $this->tourService->destroy($tour);
    }
}
