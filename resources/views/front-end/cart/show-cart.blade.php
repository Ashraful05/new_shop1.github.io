@extends('front-end.master')
@section('body')
    <div class="banner1">
        <div class="container">
            <h3><a href="{{ route('/') }}">Home</a> / <span>My shopping cart</span></h3>
        </div>
    </div>
    <!--banner-->

    <!--content-->
    <div class="content">
        <!--single-->
        <div class="single-wl3">
            <div class="container">
              <div class="row">
                <div class="col-md-11 col-md-offset-1">
                  <h3 class="text-center text-success">My Shopping Cart</h3>
                  <hr/>
                  <table class="table table-bordered">
                    <tr class="bg-primary text">
                      <th>SL NO</th>
                      <th>Name</th>
                      <th>Image</th>
                      <th>Price TK.</th>
                      <th>Quantity</th>
                      <th>Total Price TK.</th>
                      <th>Action</th>
                    </tr>
                    @php($i=1)
                    @php($sum=0)
                    @foreach($cartProducts as $cartProduct)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$cartProduct->name}}</td>
                      <td><img src="{{asset($cartProduct->options->image)}}" alt="" height="50" width="50"></td>
                      <td>{{$cartProduct->price}}</td>
                      <td>
                        {{Form::open([ 'route'=>'update-cart','method'=>'post' ])}}
                        <input type="number" name="qty" value="{{$cartProduct->qty}}" min="1 ">
                        <input type="hidden" name="rowId" value="{{$cartProduct->rowId}}" min="1">
                        <input type="submit" name="btn" value="Update">
                        {{Form::close()}}
                      </td>

                      <td>{{$total=$cartProduct->price*$cartProduct->qty}}</td>
                      <td>

                        <a href="" class="btn btn-danger btn-xs" title="Delete">
                        <span class="glyphicon glyphicon-trash"></span>
                        
                      </td>
                    </tr>
                    <?php $sum=$sum+$total; ?>
                    @endforeach
                   

                  </table>
                  <hr/>
                  <table class="table table">
                    <tr>
                      <th>Item Total (TK.)</th>
                      <th>{{$sum}}</th>
                    </tr>
                    <tr>
                      <th>Vat Total (TK.)</th>
                      <th>{{$vat=0}}</th>
                    </tr>
                    <tr>
                      <th>Grand Total {TK.}</th>
                      <th>{{$orderTotal=$sum+$vat}}</th>
                      <?php
                        Session::put('orderTotal',$orderTotal);
                      ?>
                    </tr>
                  </table>

                </div>

              </div>
              <div class="row">
                <div class="col-md-11 col-md-offset-1">
                  @if(Session::get('customerId') && Session::get('shippingId'))
                  <a href="{{route('checkout-payment')}}" class="btn btn-success pull-right">Checkout</a>
                  @elseif(Session::get('customerId'))
                  <a href="{{route('checkout-shipping')}}" class="btn btn-success pull-right">Checkout</a>
                  @else
                  <a href="{{route('checkout')}}" class="btn btn-success pull-right">Checkout</a>
                  @endif
                  <a href="" class="btn btn-success">Continue Shopping</a>

                </div>

              </div>
                <!--Product Description-->

                <!--Product Description-->
            </div>
        </div>
        <!--single-->

        <!--new-arrivals-->
    </div>
@endsection
