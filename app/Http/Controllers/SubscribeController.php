<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subscribe\SubscribeCreateRequest;
use App\Services\SubscribeService;

class SubscribeController extends Controller
{
    protected SubscribeService $subscribeService;

    public function __construct(SubscribeService $subscribeService)
    {
        $this->subscribeService = $subscribeService;
    }

    public function __invoke(SubscribeCreateRequest $request): void
    {
        $this->subscribeService->store($request->validated());
    }
}
