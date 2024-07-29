<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index () {

        $user = Auth::user();

        return view('admins.profile.index', compact(['user']));

    }

    public function edit (User $user, Request $request) {

        $request->validate([
            'email' => 'required|email|unique:users,email,'.$user->id,
            'name' => 'required|min:3'
        ], [
            'required' => ':attribute bắt buộc phải nhập',
            'min' => ':attribute phải lớn hơn :min',
            'email' => ':attribute không đúng định dạng email',
            'unique' => ':attribute đã được sử dụng',
        ], [
            'name' => 'Tên',
            'email' => 'Email',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return back()->with('msg', 'Lưu thành công');

    }

}
