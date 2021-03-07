@extends('front-end.master')

@section('body')

    <div class="container">
        <div class="row">
            <div class="col-md-12 well text-center text-success">
              Dear {{ Session::get('customerName') }}. You have to give us product payment method.
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 well">
                {{ Form::open(['route'=>'new-order','method'=>'POST']) }}
                    <table class="table table-bordered">
                        <tr>
                            <th>Cash on Delivery</th>
                            <td><input type="radio" name="payment_type" value="Cash"></td>
                        </tr>
                        <tr>
                            <th>Paypal</th>
                            <td><input type="radio" name="payment_type" value="Paypal"></td>
                        </tr>
                        <tr>
                            <th>Bkash</th>
                            <td><input type="radio" name="payment_type" value="Bkash"></td>
                        </tr>
                        <tr>
                            <th>Rocket</th>
                            <td><input type="radio" name="payment_type" value="Rocket"></td>
                        </tr>
                        <tr>
                            <th>Nagad</th>
                            <td><input type="radio" name="payment_type" value="Nagad"></td>
                        </tr>
                        <tr>
                            <th>Confirm Order</th>
                            <td><input type="submit" name="btn" value="Confirm Order"></td>
                        </tr>
                    </table>
                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection