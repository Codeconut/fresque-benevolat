<?php

namespace App\Models;

use Awcodes\FilamentGravatar\Gravatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class FresqueApplication extends Model
{
    use Notifiable, HasFactory, SoftDeletes, LogsActivity;

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
        'info_fresque'
    ];

    protected $hidden = [
        'token'
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
            get: fn (): string  => $this->first_name . ' ' . $this->last_name,
        );
    }

    protected function publicName(): Attribute
    {
        return Attribute::make(
            get: fn (): string  => $this->first_name . ' ' . $this->last_name[0] . '.',
        );
    }

    public function scopeFresqueIncoming($query)
    {
        return $query->whereHas(
            'fresque',
            fn ($query) =>
            $query->incoming()
        );
    }

    public function scopeFresquePassed($query)
    {
        return $query->whereHas(
            'fresque',
            fn ($query) =>
            $query->passed()
        );
    }
}
