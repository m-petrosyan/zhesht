<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventTicket extends Model
{
    protected $fillable = [
        'title',
        'url',
    ];

    public $timestamps = false;

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
