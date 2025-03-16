<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Tour extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'intro',
        'content',
        'slider_order',
    ];

    protected $appends = [
        'banner',
    ];

    protected $hidden = ['media'];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }


    public function getBannerAttribute(): array
    {
        $mediaData = $this->getFirstMedia('banner_file');

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
