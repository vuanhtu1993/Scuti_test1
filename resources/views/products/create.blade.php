@extends('layouts.app')
@section('content')
    <div class="row">
        {{--menu left--}}
        <div class="col-sm-3 col-md-3">
            <ul style=""> Products
                <li><a href="{{route('products.index')}}">List</a></li>
            </ul>
        </div>
        {{--content--}}
        <div class="col-sm-9 col-sm-9">

        </div>
    </div>
@endsection