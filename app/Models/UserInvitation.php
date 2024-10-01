<?php

namespace App\Models;

use App\Notifications\UserInvitationCreated;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class UserInvitation extends Model
{
    protected $fillable = [
        'email',
        'code',
        'role',
    ];

    protected static function booted()
    {
        static::created(function ($userInvitation) {
            Notification::route('slack', config('services.slack.notifications.channel'))
                ->notify(new UserInvitationCreated(Auth::user(), $userInvitation));
        });
    }

    protected function email(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
        );
    }
}
