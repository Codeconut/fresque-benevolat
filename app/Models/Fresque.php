<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Fresque extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'cover',
        'user_id',
        'places',
        'places_left',
        'state',
        'date',
        'start_at',
        'end_at',
        'is_online',
        'description',
    ];

    protected $attributes = [
        'places' => 10,
        'places_left' => 0,
        'state' => 'draft',
    ];

    protected static function booted()
    {
        static::creating(function ($fresque) {
            $fresque->user_id = Auth::id();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    protected function schedules(): Attribute
    {
        return Attribute::make(
            get: fn (): string  => Carbon::parse($this->start_at)->format('H:i') . ' - ' . Carbon::parse($this->end_at)->format('H:i'),
        );
    }
}
