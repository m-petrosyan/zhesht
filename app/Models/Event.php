<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Event extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'location',
        'date_time',
        'status',
    ];

    protected $appends = [
        'tickets',
//        'poster_file',
        'poster',
    ];

    public $timestamps = false;

    protected array $dates = ['date_time'];

    protected $casts = ['content' => 'array'];

//    public function getPosterAttribute()
//    {
//        return $this->poster_file;
//    }

    public function getPosterAttribute(): array
    {
        $mediaData = $this->getFirstMedia('poster_file');

        return [
            'id' => $mediaData?->id,
            'large' => $mediaData?->getUrl('large'),
            'thumb' => $mediaData?->getUrl('thumb'),
        ];
    }


    public function getTicketsAttribute(): Collection
    {
        return $this->tickets()->get();
    }

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
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
            ->width(300)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('large')
            ->width(600)
            ->format('webp')
            ->nonQueued();
    }
}
