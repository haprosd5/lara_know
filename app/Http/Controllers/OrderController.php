<?php

namespace App\Http\Controllers;

use App\Order;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        #region xác minh đầu vào
        $request->validate([
            "shipping_fullname" => 'required',
            "shipping_state" => 'required',
            "shipping_zipcode" => 'required',
            "shipping_address" => 'required',
            "shipping_phone" => 'required',
        ]);

        #region thiết lập order
        $order = new Order();

        $order->order_number = uniqid('OderNumber-');
        /** shipping */
        $order->shipping_fullname = $request->shipping_fullname;
        $order->shipping_state = $request->shipping_state;
        $order->shipping_zipcode = $request->shipping_zipcode;
        $order->shipping_city = $request->shipping_city;
        $order->shipping_address = $request->shipping_address;
        $order->shipping_phone = $request->shipping_phone;
        /**billing */
        if (!$request->has($request->billing_fullname)) {
            # code...
            $order->billing_fullname = $request->shipping_fullname;
            $order->billing_state = $request->shipping_state;
            $order->billing_zipcode = $request->shipping_zipcode;
            $order->billing_city = $request->shipping_city;
            $order->billing_address = $request->shipping_address;
            $order->billing_phone = $request->shipping_phone;
        } else {
            $order->billing_fullname = $request->shipping_fullname;
            $order->billing_state = $request->shipping_state;
            $order->billing_zipcode = $request->shipping_zipcode;
            $order->billing_address = $request->shipping_address;
            $order->billing_phone = $request->shipping_phone;
        }

        $order->user_id = auth()->id();

        $order->grand_total = \Cart::session(auth()->id())->getTotal();
        $order->item_count = \Cart::session(auth()->id())->getTotalQuantity();

        if ($request->payment_menthod === "payal") {
            $order->payment_menthod = "payal";
        }

        $order->save();

        /** lấy những sản phẩm đã chọn */
        $cardItem = \Cart::session(auth()->id())->getContent();

        foreach ($cardItem as $key => $item) {
            # code...
            $order->items()->attach($item->id, ['price' => $item->price, 'quantity' => $item->quantity]);
        }

        /** giỏ hàng trống */
        \Cart::session(auth()->id())->clear();
        #endregion

        /** thiết lập điều kiện chuyển hướng */
        if ($request->payment_menthod === "payal") {
            return redirect('payal/checkout/{$order->id}');
        } else {
            return redirect('/payal/checkout_cancel');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
