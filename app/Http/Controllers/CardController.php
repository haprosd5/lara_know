<?php

namespace App\Http\Controllers;


use App\Product;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /** hiển thi giỏ hàng */
    public function index()
    {
        # code...
        $data['itemSelected'] = \Cart::session(auth()->id())->getContent();
        return view('carts.index', $data);
    }
    /** thêm giỏ hàng */
    public function cardAdd($id)
    {
        # code...
        $item = Product::find($id);

        \Cart::session(auth()->id())->add(array(
            'id' => $item->id,
            'name' => $item->name,
            'price' => $item->price,
            'quantity' => 2,
            'attributes' => array(),
            'associatedModel' => $item
        ));

        return redirect('/home');
    }
    /** xóa giỏ hàng */
    public function cartDelete($id)
    {
        # code...
        \Cart::session(auth()->id())->remove($id);

        return back();
    }
    /** cập nhât giỏ hàng */
    public function cartUpdate(Request $request, $id)
    {
        # code...
        $quantity = number_format($request->quantity);

        \Cart::session(auth()->id())->update($id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $quantity,
            ),
        ));

        return back();
    }
    /** đặt hàng */
    public function cartOrder()
    {
        # code...
        return view('carts.order');
    }
}
