<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.signin');
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->has('remember');

        $user = User::where('email', $email)->orWhere('name', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user, $remember);

            // Redirect berdasarkan role
            switch (Auth::user()->role) {
                case 'admin':
                    return redirect()->route('dashboard.admin')->with('success', 'Login berhasil sebagai Admin');
                case 'ahli':
                    return redirect()->route('dashboard.ahli')->with('success', 'Login berhasil sebagai Ahli');
                case 'petani':
                    return redirect()->route('dashboard.petani')->with('success', 'Login berhasil sebagai Petani');
                default:
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'Role tidak dikenali.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Email, username atau password salah');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
