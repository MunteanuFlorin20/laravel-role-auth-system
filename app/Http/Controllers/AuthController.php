<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\User;

class AuthController extends Controller
{ 
    public $restul = true;

    public function getLogin() 
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'V-ați autentificat cu succes!');
        }

        return redirect()->route('login')->withErrors([
            'email' => 'Adresa de e-mail sau parola este incorectă!',
        ])->withInput();
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request) 
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:30',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:15|confirmed',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'activ' => 1,
            'access_level' => 1,
        ]);

        Auth::login($user);

        return redirect()->route('admin.dashboard')->with('success', 'V-ați înregistrat cu succes!');
    }
}

