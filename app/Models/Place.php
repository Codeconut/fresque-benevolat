<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Place extends Model
{
    use HasFactory, SoftDeletes, HasSlug, LogsActivity;

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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logExcept(['updated_at'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

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
