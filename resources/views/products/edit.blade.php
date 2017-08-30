@extends("layouts.app")
@section('content')

    <div class="container">
        <div class="row">
            {{--menu left--}}
            <div class="col-sm-3 col-md-3">
                <ul style=""> Products
                    <li><a href="{{route('products.index')}}">List</a></li>
                </ul>
            </div>
            {{--form edit--}}
            <div class="col-sm-9 col-sm-9">
                @if(session('message'))
                    <div class="alert-success">
                        {{session('massage')}}
                    </div>
                @endif
                @if(count($errors)>0)
                    <div style="width: 500px; height: auto;border-radius: 3px;padding-left: 10px;" class="alert-danger">
                        @foreach($errors->all() as $error)
                            {{$error}}
                            <br>
                        @endforeach
                    </div>
                @endif
                <form class="form-group" action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data" style="width: 100%">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    Name Product: <input class="form-control" type="text" name="name" value="{{$product->name}}">
                    Price: <input class="form-control" type="text" name="price" value="{{$product->price}}">
                    Description:<input style="height: 100px;" class="form-control" type="text" name="description" value="{{$product->description}}">
                    <br>
                    Select the file to upload
                    <img style="width: 724px; height: 455px" src="uploads/{{$product->link_img}}" alt="">
                    {{$product->link_img}}
                    <input class="form-inline"  type="file" name="imgUrl" value="{{$product->link_img}}">
                    <br>
                    <button type="submit">Upload</button>
                </form>
            </div>
        </div>
    </div>
    @endsection