<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public  function index(){
        $orders = Order::with('products')->where('order_type', 1)
            ->where('bill_status', 2)->get();
        return view('dashboard', [
            'orders' => $orders,
        ]);
    }
}
