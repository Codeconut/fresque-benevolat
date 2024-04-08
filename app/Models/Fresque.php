<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Fresque extends Model
{
    use HasFactory, SoftDeletes, HasSlug, LogsActivity;

    protected $fillable = [
        'name',
        'cover',
        'user_id',
        'place_id',
        'places',
        'date',
        'start_at',
        'end_at',
        'is_online',
        'is_private',
        'is_registration_open',
        'content',
        'summary',
    ];

    protected $attributes = [
        'places' => 10,
    ];

    protected $casts = [
        'is_private' => 'boolean',
        'is_online' => 'boolean',
        'is_registration_open' => 'boolean',
        'content' => 'array',

    ];

    protected $appends = [
        'schedules',
        'can_candidate',
    ];

    protected static function booted()
    {
        static::creating(function ($fresque) {
            $fresque->user_id = Auth::id();
        });

        static::saving(function ($fresque) {
            $fresque->places_left = $fresque->recomputePlacesLeft();
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logExcept(['places_left', 'updated_at'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['date', 'place.name', 'place.city', 'place.zip'])
            ->saveSlugsTo('slug');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function animators()
    {
        return $this->belongsToMany(Animator::class, 'fresques_animators');
    }

    public function applications()
    {
        return $this->hasMany(FresqueApplication::class);
    }

    public function recomputePlacesLeft()
    {
        $placesLeft = $this->places - $this->applications->count();
        return $placesLeft >= 0 ? $placesLeft : 0;
    }

    protected function schedules(): Attribute
    {
        return Attribute::make(
            get: fn (): string  => Carbon::parse($this->start_at)->format('H:i') . ' à ' . Carbon::parse($this->end_at)->format('H:i'),
        );
    }

    protected function fullDate(): Attribute
    {
        return Attribute::make(
            get: fn (): string  => Carbon::parse($this->date)->format('d M Y') . ' - ' . $this->schedules,
        );
    }

    protected function canCandidate(): Attribute
    {
        return Attribute::make(
            get: fn (): bool  => $this->is_registration_open && $this->places_left > 0 && Carbon::createFromFormat('Y-m-d', $this->date)->isFuture(),
        );
    }

    public function scopePublic($query)
    {
        return $query->where('is_private', false);
    }

    public function scopePrivate($query)
    {
        return $query->where('is_private', true);
    }

    public function scopeOnline($query)
    {
        return $query->where('is_online', true);
    }

    public function scopeIncoming($query)
    {
        return $query->where('date', '>=', Carbon::now()->format('Y-m-d'));
    }

    public function scopePassed($query)
    {
        return $query->where('date', '<', Carbon::now()->format('Y-m-d'));
    }
}
