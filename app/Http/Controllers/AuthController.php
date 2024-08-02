<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth/login');
    }

    public function register(){
        return view('auth/register');
    }

    public function simpan_user(Request $request){
        try{
            $validate = $request->validate([
                'nama_lengkap' => 'required',
                'no_hp' => 'required|digits_between:10,15',
                'email' => 'required|email|max:255',
                'password' => 'required|string|min:6',
            ]);
        }catch(\Illuminate\Validation\ValidationException $e){
            return back()->withErrors($e->errors())->withInput();
           }
        
           $hashpass = Hash::make($validate['password']);

           $user = new User();
           $user->nama_lengkap = $validate['nama_lengkap'];
           $user->no_hp = $validate['no_hp'];
           $user->email = $validate['email'];
           $user->password = $hashpass;
           $user->save();

           session()->flash('akun_dibuat');
           return redirect('/login');
    }

    public function cek_user(Request $request){
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            return redirect()->route('dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
