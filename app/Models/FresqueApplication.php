<?php

namespace App\Models;

use Awcodes\FilamentGravatar\Gravatar;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class FresqueApplication extends Model
{
    use HasFactory, LogsActivity, Notifiable, SoftDeletes;

    protected $table = 'fresque_applications';

    protected $fillable = [
        'fresque_id',
        'email',
        'first_name',
        'last_name',
        'mobile',
        'zip',
        'token',
        'state',
        'notes',
        'info_benevolat',
        'info_fresque',
        'post_fresque_engagement',
    ];

    protected $hidden = [
        'token',
    ];

    protected $attributes = [
        'state' => 'registered',
    ];

    protected $appends = [
        'full_name',
    ];

    protected static function booted()
    {
        static::creating(function ($application) {
            $application->token = bin2hex(random_bytes(16));
        });

        static::saved(function ($application) {
            $application->fresque->save();
        });

        static::addGlobalScope('owner', function (Builder $builder) {
            if (Auth::user()->hasRole('admin')) {
                return;
            }
            if (Auth::user()->hasRole('animator')) {
                $builder->whereHas('fresque', function (Builder $query) {
                    $query
                        ->where('user_id', Auth::id())
                        ->orWhereHas('animators', function (Builder $query) {
                            $query->where('id', Auth::user()->animator?->id);
                        });
                });
            }

        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logExcept(['updated_at'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function fresque()
    {
        return $this->belongsTo(Fresque::class);
    }

    public function feedback()
    {
        return $this->hasOne(FresqueApplicationFeedback::class);
    }

    protected function photo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?? Gravatar::get($this->email),
        );
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->first_name.' '.$this->last_name,
        );
    }

    protected function publicName(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->first_name.' '.$this->last_name[0].'.',
        );
    }

    public function scopeFresqueIncoming($query)
    {
        return $query->whereHas(
            'fresque',
            fn ($query) => $query->incoming()
        );
    }

    public function scopeFresquePassed($query)
    {
        return $query->whereHas(
            'fresque',
            fn ($query) => $query->passed()
        );
    }
}
