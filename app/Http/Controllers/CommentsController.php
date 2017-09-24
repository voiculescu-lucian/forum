<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentValidation;
use App\Comment;
use App\Thread;
use App\Collaborator;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewReply;

class CommentsController extends Controller
{
    public function store(CommentValidation $request, Thread $thread)
    {
    	$this->validate(request(), [
            'body'
         ]);

    	$thread->addComment(request('body'));

        // $selectedThread = Thread::where()

    	$userID = Auth::user()->id;
    	$commentID = Comment::latest()->first()->id;

    	Collaborator::create([
    		'user_id' => $userID,
    		'reply_id' => $commentID
    	]);

        $userOfThread = $thread->user;
        //Because we don't have a email for user of thread, we will hardcore the email

        \Mail::to('voiculesculucian@yahoo.com')->send(new NewReply($thread));

    	$success = "Comment was created!";
    	return back()->with('success', $success);
    }
}
