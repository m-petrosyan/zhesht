<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home', ['events' => Event::all()]);
    }
}
