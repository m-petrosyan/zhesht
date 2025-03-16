<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class EventGallery extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
    ];

    public $timestamps = false;

    protected $appends = [
        'images',
    ];

//    protected $hidden = ['media'];

    public function getImagesAttribute(): array
    {
        $mediaItems = $this->getMedia('images');

        if ($mediaItems->isEmpty()) {
            return [];
        }

        return $mediaItems->map(function (Media $media) {
            return [
                'id' => $media->id,
                'large' => $media->getUrl('large'),
                'thumb' => $media->getUrl('thumb'),
                'original' => $media->getUrl(),
            ];
        })->toArray();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(356)
            ->nonQueued();

        $this->addMediaConversion('large')
            ->width(1920);
    }
}
