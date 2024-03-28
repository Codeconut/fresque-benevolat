<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FresqueApplication extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fresques_applications';

    protected $fillable = [
        'fresque_id',
        'email',
        'first_name',
        'last_name',
        'token'
    ];

    protected $hidden = [
        'token'
    ];

    protected static function booted()
    {
        static::creating(function ($application) {
            $application->token = bin2hex(random_bytes(16));
        });
    }

    public function fresque()
    {
        return $this->belongsTo(Fresque::class);
    }
}
