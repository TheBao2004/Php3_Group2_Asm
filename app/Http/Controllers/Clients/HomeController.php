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
<<<<<<< Updated upstream
       $search = $request->input('search');
        $categories = Categories::where('active',1)->orderBy('name','ASC')->get();
        
=======
        $search = $request->input('search');
        $listCat = Categories::where('active',1)->orderBy('name','ASC')->get();

>>>>>>> Stashed changes
        $listProduct = Product::query()
        ->when($search,function($query, $search){
            return $query
            ->where('ten_san_pham','like', "%{$search}%" );
        })
        ->paginate(2);


        $product = Product::all();
<<<<<<< Updated upstream
        return view('clients.index',compact('categories','listProduct','product'));
=======
        return view('clients.index',compact('listCat','listProduct','product'));
>>>>>>> Stashed changes
    }
}
