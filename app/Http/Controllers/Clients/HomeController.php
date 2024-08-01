<?php

namespace App\Http\Controllers\Clients;

use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
       $search = $request->input('search');
        $listCate = Categories::get();
        
        $listProduct = Product::query()
        ->when($search,function($query, $search){
            return $query
            ->where('ten_san_pham','like', "%{$search}%" );
        })
        ->paginate(2);


        $product = Product::all();
        return view('clients.index',compact('listCate','listProduct','product'));
    }
}
