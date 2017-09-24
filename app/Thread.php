<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
      protected $fillable = ['id', 'user_id', 'title', 'content'];

   	public function comments()
   	{
   		return $this->hasMany(Comment::class);
   	}

   	public function user()
   	{
   		return $this->belongsTo(User::class);
   	}

   	public function addComment($body)
   	{
   		$this->comments()->create(compact('body'));
   	}
}
