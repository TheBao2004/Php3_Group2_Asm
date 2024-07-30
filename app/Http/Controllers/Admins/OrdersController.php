<?php

namespace App\Http\Controllers\Admins;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listOrder = Order::get();
        return view('admins.order.index', compact('listOrder'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $auth = $order->user;
        return view('admins.order.detail', compact('auth','order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $orders = Order::query()->findOrFail($id);
        if (!$orders) {
            return redirect()->route('order.index');
        }

        return view('admins.order.update', compact('orders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', '_method');

            $orders = Order::findOrFail($id);
            $orders->update($params);

            return redirect()->route('order.index')->with('success', 'Cập nhật trạng thái thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orders = Order::findOrFail($id);

        if ($orders) {
            $orders->details()->delete();

            $orders->delete();

            return redirect()->route('order.index')->with('success', 'Xóa đơn hàng thành công!');
        }
    }
    public function trash()
    {
        $listOrd = Order::onlyTrashed()->get();
        return view('admins.order.trash',compact('listOrd'));
    }

    public function restore($id)
    {
        $order = Order::withTrashed()->find($id);

        if ($order) {
            $order->restore();
            $order->details()->withTrashed()->restore();

            // Khôi phục các sản phẩm liên quan nếu cần
            foreach ($order->details as $item) {
                $product = Product::withTrashed()->find($item->product_id);
                if ($product) {
                    $product->restore();
                }
            }
            return redirect()->route('order.index')->with('success', 'Khôi phục đơn hàng thành công!');
        }
    }
    public function forceDelete($id) {
        Order::withTrashed()->where('id',$id)->forceDelete();
        return redirect()->route('order.trash')->with('success', 'Xóa đơn hàng thành công');;
    }
}
