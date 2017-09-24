<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ThreadValidation;
use App\Thread;
use Illuminate\Support\Facades\Auth;

class ThreadsController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function index()
	{
		$threads = Thread::latest()->get();

		return view('threads.index', ['threads' => $threads]);
	}

	public function destroy(Request $request)
	{
		$idThread = $request->id;

        $thread = Thread::find($idThread);
        $thread->delete();

        $message = 'Thread was deleted!';

    	return redirect('/profile')->with('greetings', $message);
	}

	public function update(ThreadValidation $request, Thread $thread)
	{
		$userId = Auth::user()->id;

		if(!Auth::check()) {
	        return back()->withErrors('You are not logged');
	    }

	    if($userId != $thread->user_id) {
    		return back()->withErrors('Not your thread!');
    	}

    	//verify if title contains numbers
	    if(1 === preg_match('~[0-9]~', $request->title)) {
	    	return back()->withErrors('Title must not contain numbers');
	    }

	    if(!empty($request->content)) {
	    	$content = $request->content;
		    if(substr($request->content, -1) != '.') {
		    	$content = $request->content . ".";
		    }
	    }

	    $this->validate(request(), [
            'title',
            'content'
        ]);

        $updateThread = Thread::find($request->id);
        $updateThread->fill($request->except(['id']));
        $updateThread->save();

        $message = 'Thread was updated!';

    	return redirect('/profile')->with('greetings', $message);
	}

    public function show(Thread $thread)
    {
    	$showForm = false;
    	if(Auth::user()->id == $thread->user_id) {
    		$showForm = true;
    	}

    	return view('threads.show', [
    		'thread' => $thread,
    		'show' => $showForm
    	]);
    }

    public function store(ThreadValidation $request, Thread $threads)
    {
    	if(!Auth::check()) {
	        return back()->withErrors('You are not logged');
	    }

	    $userId = Auth::user()->id;

	    //verify if title contains numbers
	    if(1 === preg_match('~[0-9]~', $request->title)) {
	    	return back()->withErrors('Title must not contain numbers');
	    }

	    // verify if content is empty and ends with .
	    $content = '';
	    if(!empty($request->content)) {
	    	$content = $request->content;
		    if(substr($request->content, -1) != '.') {
		    	$content = $request->content . ".";
		    }
	    }
	    

    	$this->validate(request(), [
            'title',
            'content'
        ]);

    	$numberThreads = $threads->where("user_id", "=", $userId)->count();

    	if($numberThreads == '5') {
    		$threads->where("user_id", "=", $userId)->oldest()->first()->delete();
    	}

    	Thread::create([
    		'user_id' => $userId,
    		'title' => request('title'),
    		'content' => $content
    	]);

    	$message = 'Thread was created!';

    	return redirect('/profile')->with('greetings', $message);
    }
}
