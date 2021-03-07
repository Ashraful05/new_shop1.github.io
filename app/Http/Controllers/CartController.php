<?php

namespace App\Http\Controllers;


use Cart;
use Illuminate\Http\Request;
use App\Product;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response

     */
     public function addToCart(Request $request){

       $product=Product::find($request->id);

       Cart::add([
         'id'=>$request->id,
         'name'=>$product->product_name,
         'price'=>$product->product_price,
         'qty'=>$request->quantity,
         'options'=>[
           'image'=>$product->product_image,
           
         ]
       ]);
        //return $request->all();
        return redirect('/cart/show');
     }

     public function showCart(){
       $cartProducts=Cart::content();
       //return $cartProducts;
       return view('front-end.cart.show-cart',['cartProducts'=>$cartProducts]);
     }

     public function deleteCart($id) {
        Cart::remove($id);

        return redirect('/cart/show');
    }

     public function updateCart(Request $request){
       Cart::update($request->rowId,$request->qty);
       return redirect('/cart/show');
     }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
