
@extends('layouts.app')
@section('content')

    <div class="container">

        <div class="row">
            {{--content--}}
                @if(Auth::check())
                    @foreach($products as $product)
                        <div class="col-sm-6 col-md-3" style="padding-left: 5px; padding-right: 5px">
                            <div class="products">
                                <img style="width: 270px; height: 170px;" src="uploads/{{$product->link_img}}" alt="">
                                <div class="products-info">
                                    <span><b>{{$product->name}}</b></span> <br>
                                    <span>{{$product->description}}</span> <br>
                                    <span style="color: red">{{$product->price}}</span> <br>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-danger">Log-in to see products</div>
                @endif
        </div>
    </div>
@endsection

