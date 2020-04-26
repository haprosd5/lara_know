<?php

namespace App\Http\Controllers;

use App\Order;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Srmklive\PayPal\Facades\PayPal;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayalController extends Controller
{
    public function getExpressCheckout($order_id)
    {
        $data = $this->checkoutData($order_id);
        $provider = new ExpressCheckout();
        $response = $provider->setExpressCheckout($data);

        /** chuyển hươngs */
        return redirect($response['paypal_link']);
    }

    public function checkoutData($order_id)
    {
        # code...
        $cart = \Cart::session(auth()->id());
        /** lấy mặt hàng đã chọn */
        $cartItems = array_map(function ($item) {
            return [
                'name' => $item['name'],
                'price' => $item['price'],
                'qty' => $item['quantity']
            ];
        }, $cart->getContent()->toarray());
        /** thiết lập thanh toán */
        $data = [
            'items' => $cartItems,
            'return_url' => url('payal/checkout_success', $order_id),
            'cancel_url' => url('payal/checkout_cancel'),
            'invoice_id' => uniqid(),
            'invoice_description' => 'Order Description',
            'total' =>  $cart->getTotal(),
        ];
        return $data;
    }

    public function getExpressCheckoutSuccess(Request $request, $order_id)
    {
        # code...
        dd($request);
        $token = $request->get('token');
        $payerId = $request->get('PayerID');
        $provider = new ExpressCheckout();
        $data = $this->checkoutData($order_id);

        $response = $provider->getExpressCheckoutDetails($token);


        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            // trang thai thanh toan
            $payment_status = $provider->doExpressCheckoutPayment($data, $token, $payerId);

            dd($payment_status);

            $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];

            if (in_array($status, ['Completed', 'Processed'])) {
                # code...
                $order = Order::find($order_id);
                $order->is_paid = true;
                $order->save();

                return redirect('/')->with('status', 'Thanh cong');
            }
        }
        return redirect('/')->with('status', 'That bai');
    }

    public function getExpressCheckoutCancel()
    {
        # code...
        return 'that bai';
    }
}
