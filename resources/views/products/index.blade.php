
@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            {{--menu left--}}
            <div class="col-sm-3 col-md-3">
                <ul style=""> Products
                    <li><a href="{{route('products.create')}}">Add products</a></li>
                </ul>
            </div>
            {{--content--}}
            <div class="col-sm-9 col-sm-9">
                @if(Auth::check())
                @foreach($products as $product)
                <div class="col-sm-6 col-md-4" style="padding-left: 5px; padding-right: 5px">
                    <div class="products">
                        <img style="width: 270px; height: 170px;" src="uploads/{{$product->link_img}}" alt="">
                        <div class="products-info">
                            <b> Product: <span>{{$product->name}}</span></b> <br>
                            Description: <span>{{$product->description}}</span> <br>
                            Price: <span style="color: red">{{$product->price}}</span> <br>
                        </div>
                        <div class="edit"><a style="color: grey" href="{{route('products.edit',$product->id)}}">Edit</a></div>
                        <div class="delete">
                            <form action="{{route('products.destroy',$product->id)}}" method="post">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button type="submit">Del</button>
                            </form>
                        </div>
                    </div>
                </div>
                    @endforeach
                    @else
                        <div class="alert alert-danger">Log-in to see products</div>
                    @endif
            </div>
        </div>
    </div>
@endsection

