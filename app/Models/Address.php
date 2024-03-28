<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Address extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    protected $fillable = [
        'name',
        'full_address',
        'zip',
        'city',
        'street',
        'latitude',
        'longitude',
        'cover',
        'photos',
        'summary'
    ];

    protected $casts = [
        'photos' => 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['name', 'full_address'])
            ->saveSlugsTo('slug');
    }

    public function fresques()
    {
        return $this->hasMany(Fresque::class);
    }
}
