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
        return view('products.index',compact('products'));
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
            'name'=>'required|min:3|max:100||unique:products',
            'price'=>'required|min:4|numeric',
            'description'=>'required|min:10|max:100',
            'imgUrl'=>'required'
        ],[
            'name.required'=>'Type name product please',
            'name.min'=>'Name product from 3 to 100 digit',
            'name.max'=>'Name product from 3 to 100 digit',
            'name.unique:products'=>'Existed this name, input another',
            'price.required'=>'Type price product please',
            'price.min'=>'Price product at least 4 digit',
            'price.numeric'=>'Price product is number',
            'description.required'=>'Type description product please',
            'description.min'=>'Description product from 10 to 100 digit',
            'description.max'=>'Description product from 10 to 100 digit',
        ]);
       $product  = new Product();
       $product->name = $request->name;
       $product->price = $request->price;
       $product->description = $request->description;
        //save file
        $file = $request->file('imgUrl');
        $destinationPath = 'uploads';
        $file->move($destinationPath,$file->getClientOriginalName()); //save image to folder
        $product->link_img = $file->getClientOriginalName(); //save name of img
        $product->save();
        $request->session()->flash('message','Storage successful');
        return back();
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
        //echo $product;
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
        $this->validate($request,[
            'name'=>'required|min:3|max:100',
            'price'=>'required|min:4|numeric',
            'description'=>'required|min:10|max:100',
        ],[
            'name.required'=>'Type name product please',
            'name.min'=>'Name product from 3 to 100 digit',
            'name.max'=>'Name product from 3 to 100 digit',
            'name.unique.products'=>'Existed this name, input another',
            'price.required'=>'Type price product please',
            'price.min'=>'Price product from 3 to 100 digit',
            'price.numeric'=>'Price product wrong type',
            'description.required'=>'Type description product please',
            'description.min'=>'Description product from 10 to 100 digit',
            'description.max'=>'Description product from 10 to 100 digit',
        ]);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        //save file (dont need required cus existed file)
        if ($request->file('imgUrl')) {
            $file = $request->file('imgUrl');
            $destinationPath = 'uploads';
            $file->move($destinationPath, $file->getClientOriginalName());
            $product->link_img = $file->getClientOriginalName(); //save name of img
        }
        $product->save();
        $request->session()->flash('message','Update successfully');
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
        return redirect('admin');
    }
}
