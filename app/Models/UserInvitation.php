<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInvitation extends Model
{

    protected $fillable = [
        'email',
        'code',
        'role'
    ];
}
