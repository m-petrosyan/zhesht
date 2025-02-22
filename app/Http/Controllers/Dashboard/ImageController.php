<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Image\ImageUploadRequest;
use Illuminate\Http\JsonResponse;

class ImageController extends Controller
{
    public function __invoke(ImageUploadRequest $imageUploadRequest): JsonResponse
    {
        $media = auth()->user()
            ->addMedia($imageUploadRequest['image'])
            ->toMediaCollection($imageUploadRequest['collection']);

        return response()->json(['url' => $media->getUrl()], 201);
    }
}
