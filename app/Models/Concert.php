<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['date'];

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    protected function formattedDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => Carbon::parse($attributes['date'])->format('F j, Y')
        );
    }

    protected function formattedStartTime(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => Carbon::parse($attributes['date'])->format('g:ia')
        );
    }

    protected function ticketPriceInDollars(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => number_format($attributes['ticket_price'] / 100, 2)
        );
    }
}
