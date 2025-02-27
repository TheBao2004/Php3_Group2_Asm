<?php

namespace App\Http\Controllers\Clients;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.client.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('clients.index');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu sai',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.client.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'required' => ':attribute bắt buộc phải nhập',
            'min' => ':attribute phải lớn hơn :min',
            'string' => ':attribute phải là kiểu chuối',
            'email' => ':attribute không đúng định dạng email',
            'unique' => ':attribute đã được sử dụng',
            'confirmed' => ':attribute xác nhận sai',
        ], [
            'name' => 'Tên',
            'email' => 'Email',
            'password' => 'Mật khẩu',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


}
