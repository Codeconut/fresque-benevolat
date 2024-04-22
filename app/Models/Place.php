<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

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
        'photos',
        'summary',
    ];

    protected $casts = [
        'photos' => 'array',
    ];

    protected $appends = [
        'photos_urls',
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

    protected function nextFresque(): Attribute
    {
        return Attribute::make(
            get: fn (): ?Fresque  => $this->fresques()->incoming()->first(),
        );
    }

    protected function photosUrls(): Attribute
    {
        return Attribute::make(
            get: fn (): array  => collect($this->photos)->map(fn ($photo) => Storage::url($photo))->toArray(),
        );
    }
}
