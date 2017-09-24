<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable = ['id', 'thread_id', 'body'];

    public function thread()
    {
    	return $this->belongsTo(Thread::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function collaborators()
    {
        return $this->belongsToMany(Collaborator::class);
    }
}
