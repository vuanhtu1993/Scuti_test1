@extends('layouts.app')
@section('content')
    <div class="container">
    <div class="row">
        {{--menu left--}}
        <div class="col-sm-3 col-md-3">
            <ul style=""> Products
                <li><a href="{{route('products.index')}}">List</a></li>
            </ul>
        </div>
        {{--form--}}
        <div class="col-sm-9 col-sm-9">
            <form class="form-group" action="{{route('products.store')}}" method="post" enctype="multipart/form-data" style="width: 100%">
                {{csrf_field()}}
                Name Product: <input class="form-control" type="text" name="name" value="">
                Price: <input class="form-control" type="text" name="price" value="">
                Description:<input style="height: 100px;" class="form-control" type="text" name="description" value="">
                <br>
                Select the file to upload
                <input class="form-inline"  type="file" name="imgUrl" value="">
                <br>
                <button type="submit">Upload</button>
            </form>
        </div>
    </div>
    </div>
@endsection