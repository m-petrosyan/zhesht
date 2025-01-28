<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subscribe\SubscribeCreateRequest;
use App\Models\Subscribe;
use App\Services\SubscribeService;

class SubscribeController extends Controller
{
    protected SubscribeService $subscribeService;

    public function __construct(SubscribeService $subscribeService)
    {
        $this->subscribeService = $subscribeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscribeCreateRequest $request): void
    {
        $this->subscribeService->store($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscribe $subscribe)
    {
        //
    }
}
