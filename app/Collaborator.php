<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    protected $fillable = ['id', 'user_id', 'reply_id'];

    public function comments()
    {
        return $this->belongsToMany(Comment::class);
    }
}
