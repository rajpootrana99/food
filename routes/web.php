<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('dashboard', 'HomeController@index')->middleware(['auth'])->name('dashboard');
Route::resource('product', 'ProductController')->middleware(['auth']);
Route::resource('order', 'OrderController')->middleware(['auth']);
Route::get('orders', 'ProductController@search')->name('order.search')->middleware(['auth']);
Route::get('filterorder/{category}', 'ProductController@filter')->name('order.filter')->middleware(['auth']);
Route::get('cart', 'CartController@index')->name('cart.index')->middleware(['auth']);
Route::post('cart', 'CartController@update')->name('cart.update')->middleware(['auth']);
Route::delete('cart/{product}', 'CartController@destroy')->name('cart.destroy')->middleware(['auth']);
Route::get('invoice', 'InvoiceController@index')->name('invoice.index')->middleware(['auth']);
//Route::get('invoices', 'InvoiceController@search')->name('invoice.search')->middleware(['auth']);

require __DIR__.'/auth.php';
