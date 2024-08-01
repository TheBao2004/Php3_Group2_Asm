<?php

namespace App\Http\Controllers\Clients;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MyaccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        return view('clients.my-account', compact(['user'])) ;
    }

    public function edit (User $user, Request $request) {
        if ($request->isMethod('POST')) {
            // Xác thực dữ liệu đầu vào
            $request->validate([
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'old_password' => 'required',
                'password' => [
                    'required',
                    'string',
                    'min:6',              // Độ dài tối thiểu 8 ký tự
                    
                ],
                'confirm_password' => 'required|same:password',
            ], [
                'required' => ':attribute bắt buộc phải nhập',
                'min' => ':attribute phải lớn hơn :min ký tự',
                'email' => ':attribute không đúng định dạng email',
                'unique' => ':attribute đã được sử dụng',
                'confirm_password.same' => 'Xác nhận mật khẩu không khớp',
                'password' => ':attribute phải bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt',
            ], [
                'name' => 'Tên',
                'email' => 'Email',
                'old_password' => 'Mật khẩu hiện tại',
                'password' => 'Mật khẩu mới',
                'confirm_password' => 'Xác nhận mật khẩu',
            ]);

            // Kiểm tra mật khẩu hiện tại
            if (!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'Mật khẩu hiện tại không đúng']);
            }

            // Lưu các thay đổi
            $user->name = $request->name;
            $user->email = $request->email;

            // Mã hóa mật khẩu mới nếu có
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return back()->with('msg', 'Lưu thành công');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
