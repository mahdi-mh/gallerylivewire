<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    public function loginView(){
        return view('auth.login');
    }

    public function ProcessLogin(Request $request)
    {
        $request->validate([
            'phone' => 'bail|required',
            'password' => 'required'
        ]);

        $credentials = $request->except(['_token']);

        if (auth()->attempt($credentials)) {
            return redirect()->route('home');
        }else{
            session()->flash('message', 'Invalid credentials');
            return redirect()->back()->withErrors(['Invalid credentials']);
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function registerView(){
        return view('auth.register');
    }

    public function registerProcess(Request $request)
    {

        $request->validate([
            'name' => 'bail|required',
            'email' => 'bail|required|unique:users|email:rfc,dns',
            'phone' => 'bail|required|unique:users|min:10',
            'password' => 'required|min:8'
        ]);


        $user = new User();
        $user->name = trim($request->input('name'));
        $user->phone = strtolower($request->input('phone'));
        $user->email = strtolower($request->input('email'));
        $user->password = strtolower($request->input('password'));
        $result = $user->makePasswordHash()->save();

        if ($result === false) return redirect()->back();

        session()->flash('message', 'Your account is created');

        Auth::login($user);

        return redirect()->route('home');
    }

}