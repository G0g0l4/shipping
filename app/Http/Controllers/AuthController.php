<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function signIn(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = [
            'username' => $request->get('username'),
            'password' => $request->get('password'),
        ];
        $findUser = User::where(['username' => $request->get('username'), 'password' => $request->get('password')]);
        if ($findUser) {
            if (Auth::attempt($user)) {
                return redirect('/');
            }
        }
        return back()->with('error', 'Username or password is incorrect!');
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function signUp(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|string',
        ]);

        $model = new User();
        DB::beginTransaction();
        $model->username = $request->get('username');
        $model->password = Hash::make($request->input($request->get('username')));
        $model->remember_token = Str::random(55);
        if ($model->save()) {
            DB::commit();
            return redirect('login');
        }
        DB::rollBack();
        return back()->with('error', 'Something went wrong!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
