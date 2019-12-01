<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;

class PayPalController extends Controller
{
    public function index(){
        return view('paypalpayment');
    }

    public function paypaySuccess(Request $request){

        $provider = new ExpressCheckout;

        $token = $request->token;
        $PayerID = $request->PayerID;
        
        $response = $provider->getExpressCheckoutDetails($token);
        $invoiceId=$response['INVNUM']??uniqid();

        $data = $this->cartData($invoiceId);

        $response = $provider->doExpressCheckoutPayment($data, $token, $PayerID);

        // dd($response);
        //save payment user info here
        // $order = new \App\Pappal();
        return 'order completed';
    }

    public function payWithPaypal(){

        $provider = new ExpressCheckout;
        $invoiceId = uniqid();
        $data = $this->cartData($invoiceId);
        
        $response = $provider->setExpressCheckout($data);
        
         // This will redirect user to PayPal
        return redirect($response['paypal_link']);
    }

    protected function cartData($invoiceId){
        $data = [];
        $data['items'] = [
            //usage need Cart::content() laravel package
            [
                'name' => 'Product 1',
                'price' => 9.99,
                'desc'  => 'Description for product 1',
                'qty' => 1
            ],
            [
                'name' => 'Product 2',
                'price' => 4.99,
                'desc'  => 'Description for product 2',
                'qty' => 2
            ]
        ];
        //use invoice id uniqid()
        $data['invoice_id'] = $invoiceId;
        $data['invoice_description'] = "test Invoice";
        $data['return_url'] = route('payment.paypalSuccess');
        // $data['cancel_url'] = url('/cart');
        $data['cancel_url'] = url('/test');

        $total = 0;
        foreach($data['items'] as $item) {
            $total += $item['price']*$item['qty'];
        }

        $data['total'] = $total;

        return $data;
    }
}
