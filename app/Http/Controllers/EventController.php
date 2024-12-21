<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\EventCreateRequest;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
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
        dd($request->validated());
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|array',
            'content.ops' => 'required|array',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
            'banner' => 'nullable|image|max:5120',
            'images.*' => 'nullable|image|max:5120',
        ]);

        $event = Event::create([
            ...$validated,
            'user_id' => auth()->id(),
            'status' => 'draft',
        ]);

        if ($request->hasFile('banner')) {
            $event->addMedia($request->file('banner'))
                ->toMediaCollection('event_banner');
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $event->addMedia($image)
                    ->toMediaCollection('event_images');
            }
        }

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

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);

        $user = User::find(1);

        $media = $user->addMedia($request->file('image'))->toMediaCollection('images');

        return response()->json(['url' => $media->getUrl()], 201);
    }
}
