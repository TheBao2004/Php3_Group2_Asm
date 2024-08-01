<?php

namespace App\Http\Controllers\Admins;

use App\Models\User;
use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comments;

class ThongKeController extends Controller
{
    //
    public function index()
    {
        $category_count = Categories::count();
        $product_count = Product::count();
        $user_count = User::count();
        $comment_count = Comments::count();
        return view('admins.thongke.index',compact('product_count','category_count','user_count','comment_count'));
    }
}
