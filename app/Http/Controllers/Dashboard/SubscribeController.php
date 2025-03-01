<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Subscribe;
use Inertia\Inertia;
use Inertia\Response;

class SubscribeController
{
    public function __invoke(): Response
    {
        $subscribers = Subscribe::all();

        return Inertia::render('Dashboard/Subscribers/Index', ['subscribers' => $subscribers]);
    }
}
