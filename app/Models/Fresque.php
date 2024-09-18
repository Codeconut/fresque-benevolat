<?php

namespace App\Models;

use App\Notifications\FresqueCreated;
use App\Notifications\FresqueUpdated;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Fresque extends Model
{
    use HasFactory, HasSlug, LogsActivity, SoftDeletes;

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
        'is_online' => true,
        'is_private' => false,
        'is_registration_open' => true,
    ];

    protected $casts = [
        'is_private' => 'boolean',
        'is_online' => 'boolean',
        'is_registration_open' => 'boolean',
        'content' => 'array',

    ];

    protected $appends = [
        'default_picture',
        'schedules',
        'can_candidate',
    ];

    protected static function booted()
    {

        static::creating(function ($fresque) {
            $fresque->user_id = Auth::id();
        });

        static::created(function ($fresque) {
            Notification::route('slack', config('services.slack.notifications.channel'))
                ->notify(new FresqueCreated(Auth::user(), $fresque));
        });

        static::updated(function ($fresque) {
            Notification::route('slack', config('services.slack.notifications.channel'))
                ->notify(new FresqueUpdated(Auth::user(), $fresque));
        });

        static::saving(function ($fresque) {
            $fresque->places_left = $fresque->recomputePlacesLeft();
        });

        // static::addGlobalScope('owner', function (Builder $builder) {
        //     if (Auth::user()->hasRole('admin')) {
        //         return;
        //     }
        //     if (Auth::user()->hasRole('animator')) {
        //         $builder
        //             ->where('user_id', Auth::id())
        //             ->orWhereHas('animators', function (Builder $query) {
        //                 $query->where('id', Auth::user()->animator?->id);
        //             });
        //     }

        // });
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
        return $this->belongsToMany(Animator::class, 'fresque_animators');
    }

    public function applications()
    {
        return $this->hasMany(FresqueApplication::class);
    }

    public function recomputePlacesLeft()
    {
        $placesLeft = $this->places - $this->applications->whereIn('state', ['registered', 'confirmed_presence', 'validated'])->count();

        return $placesLeft >= 0 ? $placesLeft : 0;
    }

    protected function schedules(): Attribute
    {
        return Attribute::make(
            get: fn (): string => Carbon::parse($this->start_at)->format('H\hi').' à '.Carbon::parse($this->end_at)->format('H\hi'),
        );
    }

    protected function defaultPicture(): Attribute
    {
        $picture = null;

        if ($this->cover) {
            $picture = $this->cover;
        } elseif ($this->place) {
            if ($this->place?->photos) {
                $picture = $this->place?->photos[0];
            }
        }

        return Attribute::make(
            get: fn (): ?string => $picture ? Storage::url($picture) : null,
        );
    }

    protected function fullDate(): Attribute
    {
        return Attribute::make(
            get: fn (): string => Carbon::parse($this->date)->translatedFormat('d F Y').' - '.$this->schedules,
        );
    }

    protected function canCandidate(): Attribute
    {
        return Attribute::make(
            get: fn (): bool => $this->is_registration_open && $this->places_left > 0 && Carbon::createFromFormat('Y-m-d', $this->date)->isFuture(),
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

    public function scopeManagedBy($query, $user)
    {
        if ($user->hasRole('admin')) {
            return $query;
        }

        return $query
            ->where('user_id', $user->id)
            ->orWhereHas('animators', function (Builder $query) use ($user) {
                $query->where('id', $user->animator?->id);
            });
    }
}
