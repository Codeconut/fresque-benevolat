<?php

namespace App\Models;

use Awcodes\FilamentGravatar\Gravatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class FresqueApplication extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fresques_applications';

    protected $fillable = [
        'fresque_id',
        'email',
        'first_name',
        'last_name',
        'token',
        'has_confirmed_presence',
        'notes'
    ];

    protected $hidden = [
        'token'
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

    public function fresque()
    {
        return $this->belongsTo(Fresque::class);
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
