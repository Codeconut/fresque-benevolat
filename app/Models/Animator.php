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
    ];

    protected $appends = [
        'full_name'
    ];

    public function fresques()
    {
        return $this->belongsToMany(Fresque::class, 'fresques_animators');
    }

    public function incomingFresques()
    {
        return $this->belongsToMany(Fresque::class, 'fresques_animators')->where('date', '>=', now());
    }

    protected function photo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?? $this->getGravatar($this->email),
        );
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn (): string  => $this->first_name . ' ' . $this->last_name,
        );
    }

    private function getGravatar()
    {
        return Gravatar::get($this->email);
    }
}
