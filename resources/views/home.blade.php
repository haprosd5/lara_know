@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Products</h2>
    <div class="row">
        <div class="card">
            <img class="card-img-top" src="{{asset('default_img.jpg')}}" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title">Dog</h4>
                <p class="card-text">Dog Stupid</p>
            </div>
            <div class="card-body">
                <a href="#" class="card-link">Card Add</a>

            </div>
        </div>
    </div>
</div>
@endsection
