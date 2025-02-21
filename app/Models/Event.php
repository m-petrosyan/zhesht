<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

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
    ];

    protected array $dates = ['date_time'];

    protected $casts = ['content' => 'array'];


    /*
     * @return HasMany
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(EventTicket::class);
    }
}
