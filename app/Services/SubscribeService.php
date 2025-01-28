<?php

namespace App\Services;

use App\Models\Subscribe;

class SubscribeService
{
    public function store(array $attributes): void
    {
        Subscribe::query()->create($attributes);
    }
}
