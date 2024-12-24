<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Event extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'content',
        'date_time',
        'status',
    ];

    protected $appends = [
        'banner',
    ];

    protected $casts = ['content' => 'array'];

    public function getBannerAttribute(): array
    {
        $mediaData = $this->getFirstMedia('banner');

        return [
            'id' => $mediaData->id,
            'large' => $mediaData?->getUrl('banner'),
            'thumb' => $mediaData?->getUrl('thumb'),
        ];
    }

    /*
     * @return HasMany
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(356)
            ->height(356)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('banner')
            ->format('webp')
            ->nonQueued();
    }
}
