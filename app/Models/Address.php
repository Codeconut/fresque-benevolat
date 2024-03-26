<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'full_address',
        'zip',
        'city',
        'street',
        'latitude',
        'longitude',
    ];

    public function fresques()
    {
        return $this->hasMany(Fresque::class);
    }
}
