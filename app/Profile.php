<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $fillable = [
        'username', 'password',
    ];

    protected $hidden = [
        'password',
    ];
}