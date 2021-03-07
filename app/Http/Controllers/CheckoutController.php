<?php

namespace App\Http\Controllers;

use App\Checkout;
use App\Customer;
use App\Shipping;
use App\Order;
use App\Payment;
use App\OrderDetails;
use Cart;
use Illuminate\Http\Request;
use Mail;
use Session;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front-end.checkout.checkout-content');
    }

    public function customerSignUp(Request $request)
    {
        $this->validate($request,[
            'email_address'=>'email|unique:customers,email_address'
        ]);

        $customer = new Customer();
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email_address = $request->email_address;
        $customer->password = bcrypt($request->password);
        $customer->phone_number = $request->phone_number;
        $customer->address = $request->address;
        $customer->save();

        $customerId = $customer->id;
        Session::put('customerId',$customerId);
        Session::put('customerName',$customer->first_name.' '.$customer->last_name);

        $data = $customer->toArray();
        //return $data;

        Mail::send('front-end.mails.confirmation-mail', $data, function ($message) use ($data) {
            $message->to($data['email_address']);
            $message->subject('Confirmation mail');
        });
        return 'success';
        return redirect('/checkout/shipping');

    }
    public function customerLoginCheck(Request $request){
       // return bcrypt($request->password);
        $customer=Customer::where('email_address',$request->email_address)->first();


        if (password_verify($request->password, $customer->password)) {
            Session::put('customerId',$customer->id);
            Session::put('customerName',$customer->first_name.' '.$customer->last_name);

            return redirect('/checkout/shipping');


        } else {
            return redirect('/checkout')->with('message','Insert valid password.......');
        }
        //return $customer;
    }

    public function customerLogout(){
        Session::forget('customerId');
        Session::forget('customerName');
        
        return redirect('/');
    }

    public function newCustomerLogin(){
        return view('front-end.customer.customer-login');
    }




    public function shippingForm(){
        $customer=Customer::find(Session::get('customerId'));
        return view('front-end.checkout.shipping',['customer'=>$customer]);
    }


    public function saveShippingInfo(Request $request){
        $shipping=new Shipping();
        $shipping->full_name=$request->full_name;
        $shipping->email_address=$request->email_address;
        $shipping->phone_number=$request->phone_number;
        $shipping->address=$request->address;
        $shipping->save();

        Session::put('shippingId',$shipping->id);
        return redirect('/checkout/payment');
    }


    public function paymentForm(){
        return view('front-end.checkout.payment');
    }


    public function newOrder(Request $request){
        //return $request->all();

        $paymentType=$request->payment_type;
        if($paymentType=='Cash'){
            $order=new Order();
            $order->customer_id=Session::get('customerId');
            $order->shipping_id=Session::get('shippingId');
            $order->order_total=Session::get('orderTotal');
            $order->save();


            $payment=new Payment();
            $payment->order_id=$order->id;
            $payment->payment_type=$paymentType;
           
            $payment->save();

            $cartProducts=Cart::content();
            foreach($cartProducts as $cartProduct)
            {
                $orderDetail=new OrderDetails();
                $orderDetail->order_id=$order->id;
               
                $orderDetail->product_id=$cartProduct->id;
                $orderDetail->product_name=$cartProduct->name;
                $orderDetail->product_price=$cartProduct->price;
                $orderDetail->product_quantity=$cartProduct->qty;
                $orderDetail->save();
                

            }
            Cart::destroy();
            return redirect('/complete/order');

        }else if($paymentType=='Paypal'){

        }else if($paymentType=='Bkash'){

        }else if($paymentType=='Rocket'){

        }else if($paymentType=='Nagad'){

        }
    }

    public function ajaxEmailCheck($a){
        $customer=Customer::where('email_address',$a)->first();
        if($customer){
            echo 'Already Exist';
        }
        else{
            echo 'available';
        }
    }

    public function completeOrder(){
        return 'success';
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
}
