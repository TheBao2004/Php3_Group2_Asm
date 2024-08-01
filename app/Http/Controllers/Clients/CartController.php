<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // 
    public function listCart(){
        $cart = session()->get('cart', []);
            // dd(session()->all());
        
        $total = 0;
        $subTotal = 0;

        foreach ($cart as $item) {
            $subTotal += $item['gia'] * $item('so_luong');

        }
        $shipping = 30000;
        $total = $subTotal + $shipping;
        return view('clients.cart',compact('cart','total', 'subTotal','shipping'));
    } 
    public function addCart(Request $request){
        $productID = $request->input('product_id');
        $quantity = $request->input('quantity');

        // dd($request->all());
        $proDuct = Product::query()->findOrFall($productID);
        //khởi tạo 1 mảng chứa thông tin giỏ hàng trên session
        $cart = session()->get('cart', []);
        if (isset($cart[$productID])) {
            //Sản phẩm đã tồn tại trong giỏ hàng
            $cart[$productID]['so_luong'] += $quantity;
            //Sản phẩm chưa tồn tại trong giỏ hàng
        }else{
            $cart[$productID] = [
                'ten_san_pham' => $proDuct->ten_san_pham,
                'so_luong' => $proDuct->quantity,
                'gia' => isset($proDuct->gia_khuyen_mai) ? $proDuct->gia_khuyen_mai : $proDuct->gia_san_pham,
                'hinh_anh' => $proDuct->hinh_anh

            ];
            session()->put('cart', $cart);
            // dd(session()->all());
        }
        return redirect()->back();

    } 
    public function updateCart(Request $request){
        $cartNew = $request->input('cart',[]);
        session()->put('cart', $cartNew);
        return redirect()->back();

    } 

}
