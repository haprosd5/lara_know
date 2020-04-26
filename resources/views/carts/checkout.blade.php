@extends('layouts.app')

@section('content')
<div>
    <h2>Check out Details</h2>
    <hr>
    <form action="{{ route('orders.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="">Ho ten</label>
            <input class="form-control" type="text" name="shipping_fullname" id="">
        </div>
        <div class="form-group">
            <label for="">Trang thai</label>
            <input class="form-control" type="text" name="shipping_state" id="">
        </div>
        <div class="form-group">
            <label for="">Thanh pho</label>
            <input class="form-control" type="text" name="shipping_state" id="">
        </div>
        <div class="form-group">
            <label for="">Ma zipcode</label>
            <input class="form-control" type="text" name="shipping_zipcode" id="">
        </div>
        <div class="form-group">
            <label for="">Dia chi</label>
            <input class="form-control" type="text" name="shipping_address" id="">
        </div>
        <div class="form-group">
            <label for="">Thanh pho</label>
            <input class="form-control" type="text" name="shipping_city" id="">
        </div>
        <div class="form-group">
            <label for="">So dien thoai</label>
            <input class="form-control" type="text" name="shipping_phone" id="">
        </div>
        <h4>Hinh thuc tra tien cho san pham</h4>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" value="payal" id="" name="payment_menthod">
            <label class="form-check-label">Payal</label>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="" name="payment_menthod" value="home">
            <label class="form-check-label">Cash Home Delivery</label>
        </div>
        <button type="submit" class="btn btn-primary">Place order</button>

    </form>

</div>
@endsection
