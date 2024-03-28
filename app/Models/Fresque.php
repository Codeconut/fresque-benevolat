<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Fresque extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    protected $fillable = [
        'name',
        'cover',
        'user_id',
        'address_id',
        'places',
        'date',
        'start_at',
        'end_at',
        'is_online',
        'is_registration_open',
        'content',
        'summary',
    ];

    protected $attributes = [
        'places' => 10,
    ];

    protected $casts = [
        'is_online' => 'boolean',
        'is_registration_open' => 'boolean',
        'content' => 'array',
    ];

    protected static function booted()
    {
        static::creating(function ($fresque) {
            $fresque->user_id = Auth::id();
        });

        static::saving(function ($fresque) {
            $fresque->places_left = $fresque->places - 0;
        });
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['date', 'address.name', 'address.city', 'address.zip'])
            ->saveSlugsTo('slug');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function animators()
    {
        return $this->belongsToMany(Animator::class, 'fresques_animators');
    }

    protected function schedules(): Attribute
    {
        return Attribute::make(
            get: fn (): string  => Carbon::parse($this->start_at)->format('H:i') . ' - ' . Carbon::parse($this->end_at)->format('H:i'),
        );
    }

    public function scopeOnline($query)
    {
        return $query->where('is_online', true);
    }

    public function scopeIncoming($query)
    {
        return $query->where('date', '>=', Carbon::now());
    }
}
