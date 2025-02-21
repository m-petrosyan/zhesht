<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Tour extends Model
{
    protected $fillable = [
        'title',
        'content',
    ];

    protected $appends = [
        'poster',
    ];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }


    public function getPosterAttribute(): array
    {
        $mediaData = $this->getFirstMedia('poster');

        return [
            'id' => $mediaData->id,
            'large' => $mediaData?->getUrl('large'),
            'thumb' => $mediaData?->getUrl('thumb'),
        ];
    }

    public function getTicketsAttribute()
    {
        return $this->tickets()->get();
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
