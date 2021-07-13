<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $order = Order::with('products')->take(1)->where('bill_status', 0)->first();
        return view('cart.index', [
            'order' => $order,
        ]);
    }

    public function update(Request $request){
        if($request->order_type == 1) {
            $request->validate([
                'table' => 'required',
            ]);
            $order = Order::where('id', $request->id)->update([
                'bill_status' => 2,
                'order_type' => $request->order_type,
                'table' => $request->table,
            ]);
            return redirect(route('dashboard'));
        }
        else{
            $order = Order::where('id', $request->id)->update([
                'order_type' => $request->order_type,
                'bill_status' => 1,
            ]);
            $order = Order::where('id', $request->id)->first();
            return view('reports.receipt', [
                'order' => $order,
            ]);
        }
    }

    public function destroy(Product $product){
        $product->orders()->detach($product->order_id);
        return redirect(route('order.index'));
    }
}
