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
        'location',
        'date_time',
        'status',
    ];

    protected $appends = [
        'poster',
    ];

    protected array $dates = ['date_time'];

    protected $casts = ['content' => 'array'];

    public function getPosterAttribute(): array
    {
        $mediaData = $this->getFirstMedia('poster');

        return [
            'id' => $mediaData->id,
            'large' => $mediaData?->getUrl('large'),
            'thumb' => $mediaData?->getUrl('thumb'),
        ];
    }

    /*
     * @return HasMany
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(EventTicket::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(356)
            ->height(356)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('large')
            ->format('webp')
            ->nonQueued();
    }
}
