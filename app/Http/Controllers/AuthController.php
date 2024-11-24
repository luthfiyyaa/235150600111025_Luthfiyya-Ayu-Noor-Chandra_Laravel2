<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan halaman registrasi
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        // Validasi inputan
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // Menambahkan validasi konfirmasi password
        ]);

        // Hash password sebelum disimpan
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Simpan user baru
        User::create($validatedData);

        // Redirect ke login setelah berhasil registrasi
        return redirect('/login');
    }


    // Tampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Coba login menggunakan email dan password
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect ke dashboard atau halaman yang diinginkan setelah login
            return redirect('/blogs');
        }

        // Jika login gagal
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }


    // In AuthController
    public function logout()
    {
        // Remove the user session data
        session()->forget('user');

        // Optionally, you can use Auth::logout() if you're using Laravel's built-in authentication
        Auth::logout();

        // Redirect to login page or another page after logout
        return redirect('/login');
    }

}
