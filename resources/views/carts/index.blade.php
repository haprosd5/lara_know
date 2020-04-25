@extends('layouts.app')

@section('content')
<div>
    <h2>Cart content</h2>
    {{-- {{dd($itemSelected) }} --}}


    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($itemSelected as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td scope="row">{{ $item->name }}</td>
                    <td>{{ \Cart::session(auth()->id())->get($item->id)->getPriceSum() }}</td>
                    <td>
                        <form action="{{ url('cart/update/'.$item->id) }}" method="get">
                            <input type="number" name="quantity" type="text" value="{{ $item->quantity }}">
                            |
                            <button class="btn btn-info btn-sm"><span class="fa fa-pen"></span></button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ url('cart/delete/'.$item->id) }}"
                            class="btn btn-danger  btn-sm"><span class="fa fa-trash"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
<h3>Total: {{ \Cart::session(auth()->id())->getTotal() }}$</h3>
<a href="{{ url('cart/order') }}" class="btn btn-primary btm-sm">Procees check out</a>
</div>
@endsection
