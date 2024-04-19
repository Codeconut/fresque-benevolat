<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class FresqueApplicationFeedback extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $table = 'fresque_application_feedbacks';

    protected $fillable = [
        'fresque_application_id',
        'rating',
        'questions',
    ];

    protected $casts = [
        'questions' => 'array',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logExcept(['updated_at'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function application()
    {
        return $this->belongsTo(FresqueApplication::class, 'fresque_application_id');
    }
}
