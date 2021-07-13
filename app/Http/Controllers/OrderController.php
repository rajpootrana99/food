<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Product::distinct()->get(['category_name']);
        $products = Product::all();
        $order = Order::with('products')->take(1)->where('bill_status', 0)->first();
        return view('order.product', [
            'order' => $order,
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        if($order){
            $order->products()->attach($request->product_id, ['qty' => $request->qty]);
            $categories = Product::distinct()->get(['category_name']);
            $products = Product::all();
            return view('order.product', [
                'order' => $order,
                'products' => $products,
                'categories' => $categories,
            ]);
        }
        $order = Order::where('bill_status', 0)->first();
        if(!$order){
            $order = Order::create([
                'order_date' => date("Y/m/d"),
                'bill_status' => 0,
            ]);
            $order->products()->attach($request->product_id, ['qty' => $request->qty]);
        }
        else{
            $order->products()->attach($request->product_id, ['qty' => $request->qty]);
        }
        $categories = Product::distinct()->get(['category_name']);
        $products = Product::all();
        $order = Order::with('products')->take(1)->where('bill_status', 0)->first();
        return view('order.product', [
            'order' => $order,
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $categories = Product::distinct()->get(['category_name']);
        $products = Product::all();
        return view('order.product', [
            'order' => $order,
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->update([
            'bill_status' => 1,
        ]);
        return view('reports.receipt', [
            'order' => $order,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
