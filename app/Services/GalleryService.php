<?php

namespace App\Services;

class GalleryService
{
    public function store(object $event, array $attributes): void
    {
        $gallery = $event->galleries()->create($attributes);

        foreach ($attributes['images'] as $image) {
            $gallery->addMedia($image)
                ->toMediaCollection('images');
        }
    }

    public function destroy(object $gallery): void
    {
        $gallery->delete();

        $gallery->clearMediaCollection('images');
    }
}
