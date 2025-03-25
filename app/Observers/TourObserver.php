<?php

namespace App\Observers;

use App\Models\Tour;
use Illuminate\Support\Str;

class TourObserver
{
    public function created(Tour $tour): void
    {
        $tour->slug = Str::slug($tour->title);
        $tour->save();
    }
}
