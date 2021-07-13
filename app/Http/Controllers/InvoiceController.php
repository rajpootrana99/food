<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request){
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        if($request->all()){
            $orders = Order::with('products')->where('order_date', '>=', $start_date)
                ->where('order_date', '<=', $end_date)->get();
        }
        else{
            $orders = Order::with('products')->where('bill_status', 1)->orWhere('bill_status', 2)->get();
        }
        return view('invoice.index', [
            'orders' => $orders,
        ]);
    }

    public function search(Request $request){

    }
}
