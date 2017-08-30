<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

//        return view('products.index')
        return view('products/index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // required input
        $this->validate($request,[
            'name'=>'required|min:3|max:100'
        ],[
            'name.required'=>'Type name product please',
            'name.min'=>'Name product from 3 to 100 digit',
            'name.max'=>'Name product from 3 to 100 digit',
        ]);
       $product  = new Product();
       $product->name = $request->name;
       $product->price = $request->price;
       $product->description = $request->description;
        //save file
        $file = $request->file('imgUrl');
        $destinationPath = 'uploads';
        $file->move($destinationPath,$file->getClientOriginalName());
        $product->link_img = $file->getClientOriginalName(); //save name of img
        $product->save();
        return back()->with('message','create successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        //save file
        if ($request->file('imgUrl')) {
            $file = $request->file('imgUrl');
            $destinationPath = 'uploads';
            $file->move($destinationPath, $file->getClientOriginalName());
            $product->link_img = $file->getClientOriginalName(); //save name of img
        }
        $product->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('products');
    }
}
