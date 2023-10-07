<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function loginForm(UserLoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');


        $user = User::where('email', $email)->first();
        if ($user) {
            if (Hash::check($password, $user->password)) {
                Auth::login($user);
                return redirect()->route('admin.home')->with('info', $request->rememberMe ?? 'off');
            } else {
                return redirect()
                    ->back()
                    ->with('error','Password Error!');
            }
        } else {
            return redirect()
                ->back()
                ->with('error','Creditial Error!');
        }

        if ($request->rememberMe == 'on') {
            echo 'Remember me is on';
        } else {
            echo 'Remember me is off';
        }
        dd($request->all());
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
