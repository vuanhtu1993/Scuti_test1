<?php

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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin', ['middleware'=>'admin',function(){
    $products = \App\Product::all();
    return view('products.index',compact('products'));
}]);

Route::get('/',function (){
    $products = \App\Product::all();
    return view('layouts.index',compact('products'));
});

Route::resource('products','ProductController');

