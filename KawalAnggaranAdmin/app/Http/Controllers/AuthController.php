<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $validator = Validator::make($credentials, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('username', $credentials['username'])->first();

        if ($user && $credentials['password'] == $user->password) {
            Auth::login($user);
            return redirect()->route('admin.regIncome.index');
        }

        return redirect()->back()->withErrors(['Invalid credentials.'])->withInput();
    }

    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:users',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'username' => $request->username,
            'password' => $request->password,
        ]);

        return redirect()->route('login.form')->with('success', 'User created successfully.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }
}
