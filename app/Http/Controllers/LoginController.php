<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            if ($user->level === 'Admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->level === 'User') {
                return redirect()->route('user.dashboard');
            }
        }

        return view('login');
    }

    public function proses_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        $credentials = $request->only('email', 'password');
        // dd($credentials);
        
        if (Auth::attempt($credentials)) {
            // dd("test");

            $user = Auth::user();

            if ($user->level === 'Admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->level === 'User') {
            // dd($user->level);

                return redirect()->route('user.dashboard');
            } else {
                Auth::logout();
                // dd('test');
                return redirect()->route('login')->with('error', 'Level tidak dikenali.');
            }
        }

        return redirect()->route('login')
            ->with('error', 'Email atau password salah, Silahkan coba lagi')
            ->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect()->route('login');
    }

}
