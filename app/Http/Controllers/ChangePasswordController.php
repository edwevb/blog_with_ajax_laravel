<?php

namespace App\Http\Controllers;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

class ChangePasswordController extends Controller
{
	public function index(Request $request)
	{
		return view('admin.change_password');
	}

	public function store(Request $request)
	{
		$request->validate([
			'current_password' => ['required', new MatchOldPassword],
			'new_password' => ['required'],
			'new_confirm_password' => ['same:new_password'],
		]);

		$user = User::findOrFail(auth()->user()->id);
		$user->update(['password'=> Hash::make($request->new_password)]);
		if ($user) {
			\Auth::logout();
			session()->flash('success', 'Password successfully changed!');
			return redirect()->route('login');
		}
	}
}
