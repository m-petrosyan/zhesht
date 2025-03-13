<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Tour extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'content',
        'slider_order',
    ];

    protected $appends = [
        'banner_file',
        'poster_file',
    ];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }


    public function getBannerFileAttribute(): array
    {
        $mediaData = $this->getFirstMedia('banner_file');

        return [
            'id' => $mediaData?->id,
            'large' => $mediaData?->getUrl('large'),
            'thumb' => $mediaData?->getUrl('thumb'),
        ];
    }

    public function getPosterFileAttribute(): array
    {
        $mediaData = $this->getFirstMedia('poster_file');


        return [
            'id' => $mediaData?->id,
            'large' => $mediaData?->getUrl('large'),
            'thumb' => $mediaData?->getUrl('thumb'),
        ];
    }


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(356)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('large')
            ->width(1920)
            ->format('webp')
            ->nonQueued();
    }
}
