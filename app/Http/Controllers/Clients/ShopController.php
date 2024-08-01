<?php

namespace App\Http\Controllers\Clients;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;

class ShopController extends Controller
{
    
    public function index()
    {
        $listCat = Categories::get();
        $listCate = Categories::get();
        $feature_products = Product::limit(3)->get();
        return view('clients.productcatedetail.shop',compact('feature_products','listCate','listCat'));
    }

    public function product($id)
    {
        $listCate = Categories::get();
        $feature_products = Product::where('categories_id', $id)->get();
        return view('clients.productcatedetail.productcate', compact('feature_products','listCate'));
    }
    
}
