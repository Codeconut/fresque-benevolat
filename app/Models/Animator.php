<?php

namespace App\Models;

use Awcodes\FilamentGravatar\Gravatar;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Animator extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile',
        'photo',
        'level',
        'zip',
        'city',
        'professional_status',
        'availability',
        'notes',
    ];

    protected $casts = [
        'availability' => 'array',
    ];

    protected $appends = [
        'full_name',
        'public_name',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logExcept(['updated_at'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fresques()
    {
        return $this->belongsToMany(Fresque::class, 'fresque_animators');
    }

    public function incomingFresques()
    {
        return $this->belongsToMany(Fresque::class, 'fresque_animators')->incoming();
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

    protected function fullAddress(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->zip.' '.$this->city,
        );
    }

    protected function publicName(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->first_name.' '.$this->last_name[0].'.',
        );
    }

    protected function nextFresque(): Attribute
    {
        return Attribute::make(
            get: fn (): ?Fresque => $this->fresques()->incoming()->first(),
        );
    }
}
