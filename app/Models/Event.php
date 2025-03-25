<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Event extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'location',
        'date_time',
        'status',
    ];

    protected $appends = [
        'tickets',
        'poster',
    ];

    protected $hidden = ['media'];

    public $timestamps = false;

    protected array $dates = ['date_time'];

    protected $casts = ['content' => 'array', 'date_time' => 'datetime'];

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
        return $this->date_time->isPast() ? collect([]) : $this->tickets()->get();
    }

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(EventGallery::class);
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
            ->nonQueued();

        $this->addMediaConversion('large')
            ->width(1920)
            ->nonQueued();
    }
}
