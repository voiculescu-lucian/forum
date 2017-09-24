<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUser;
use App\Profile;
use App\Thread;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
	protected $username;

	public function __construct()
    {
        $this->middleware('auth');
    }

	public function index(Thread $threads)
	{
		$user = Auth::user();
		$userThreads = $threads->where("user_id", "=", $user->id)->latest()->get();
	    $this->username = $user->username;
		
		return view('profile', [
			'username' => $this->username,
			'threads' => $userThreads
		]);
	}

	public function update(UpdateUser $request)
	{

		if(!\Hash::check($request->oldpassword, Auth::user()->password)) {
			return back()->withErrors('Wrong old password');
		}

		$this->validate(request(), [
            'username',
            'password'
         ]);

		$request->user()->fill([
			'username' => $request->username,
            'password' => \Hash::make($request->password)
        ])->save();

        $message = 'Profile was updated';

		return redirect()->back()->with('threadCreated', $message);
	}
}