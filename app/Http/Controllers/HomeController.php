<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::query()->where('date_time', '>', now())->get();
        $pastEvents = Event::query()->where('date_time', '<', now())->get();

        return Inertia::render('Home', ['events' => $events, 'pastEvents' => $pastEvents]);
    }
}
