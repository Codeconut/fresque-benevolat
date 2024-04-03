<?php

namespace App\Models;

use Awcodes\FilamentGravatar\Gravatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Animator extends Model
{
    use HasFactory, SoftDeletes;

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
        'notes'
    ];

    protected $appends = [
        'full_name',
        'public_name'
    ];

    public function fresques()
    {
        return $this->belongsToMany(Fresque::class, 'fresques_animators');
    }

    public function incomingFresques()
    {
        return $this->belongsToMany(Fresque::class, 'fresques_animators')->incoming();
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

    protected function fullAddress(): Attribute
    {
        return Attribute::make(
            get: fn (): string  => $this->zip . ' ' . $this->city,
        );
    }

    protected function publicName(): Attribute
    {
        return Attribute::make(
            get: fn (): string  => $this->first_name . ' ' . $this->last_name[0] . '.',
        );
    }
}
