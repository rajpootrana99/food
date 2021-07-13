<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Traits\GeneralTrait;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Testing\ParallelTesting;

class ProductController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->all());
        $this->storeImage($product);
        return redirect(route('product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show',[
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());
        $this->storeImage($product);
        return redirect(route('product.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect(route('product.index'));
    }

    public function storeImage($product){
        $product->update([
            'image' => $this->imagePath('image', 'products', $product),
        ]);
    }

    public function search(Request $request){
        $categories = Product::distinct()->get(['category_name']);
        $products = Product::where('name', 'like', '%'.$request->search_name.'%')
            ->orWhere('category_name', 'like', '%'.$request->search_name.'%')->get();
        $order = Order::with('products')->take(1)->where('bill_status', 0)->first();
        return view('order.product', [
            'order' => $order,
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function filter($category){
        $categories = Product::distinct()->get(['category_name']);
        if($category == 'all'){
            $products = Product::all();
        }
        else{
            $products = Product::where('category_name', $category)->get();
        }
        $order = Order::with('products')->take(1)->where('bill_status', 0)->first();
        return view('order.product', [
            'order' => $order,
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
