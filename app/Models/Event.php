<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{

    protected $fillable = [
        'location',
        'date_time',
        'status',
    ];

    protected $appends = [
        'tickets',
    ];

    public $timestamps = false;

    protected array $dates = ['date_time'];

    protected $casts = ['content' => 'array'];

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
}
