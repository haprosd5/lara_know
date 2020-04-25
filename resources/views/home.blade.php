@extends('layouts.app')

@section('content')
<div class="text-center">
    <h2>Products</h2>
    <div class="row">
        @foreach ($products as $item)
        <div class="col-4 mb-2">
            <div class="card">
                <img class="card-img-top" src="{{asset('default_img.jpg')}}" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title">{{$item->name}}</h4>
                    <p class="card-text">{{$item->desciption}}</p>
                <h2>{{$item->price}}$</h2>
                </div>
                <div class="card-body">
                    <a href="{{ url('cart/add_card/'. $item->id) }}" class="card-link">Add to Card</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection
