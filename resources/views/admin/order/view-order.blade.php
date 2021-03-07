@extends('admin.master')
@section('body')
<br/>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="text-center text-success">View Order Form</h4>
            </div>
            <div class="panel-body">
                <h3 class="text-center text-success">Order Details Info For This Order</h3>
                <table class="table table-bordered">
                    <tr>
                     <th>Order No</th>   
                     <td>{{$order->id}}</td>
                    </tr>
                    <tr>
                     <th>Order Total</th>   
                     <td>{{$order->order_total}}</td>
                    </tr>
                    <tr>
                     <th>Order Status</th>   
                     <td>{{$order->order_status}}</td>
                    </tr>
                    <tr>
                     <th>Order Date</th>   
                     <td>{{$order->created_at}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
           
            <div class="panel-body">
            	<h3 class="text-center text-success">Customer Info For This Order</h3>
                <table class="table table-bordered">
                	<tr>
                     <th>Customer Name</th>   
                     <th>{{$customer->first_name.' '.$customer->last_name}}</th>
                    </tr>
                    <tr>
                     <th>Phone Number</th>   
                     <th>{{$customer->phone_number}}</th>
                    </tr>
                    <tr>
                     <th>Email Address</th>   
                     <th>{{$customer->email_address}}</th>
                    </tr>
                    <tr>
                     <th>Address</th>   
                     <th>{{$customer->address}}</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3 class="text-center text-success">Shipping Info For This Order</h3>
                <table class="table table-bordered">
                    <tr>
                     <th>Full Name</th>   
                     <th>{{$shipping->full_name}}</th>
                    </tr>
                    <tr>
                     <th>Phone Number</th>   
                     <th>{{$shipping->phone_number}}</th>
                    </tr>
                    <tr>
                     <th>Email Address</th>   
                     <th>{{$shipping->email_address}}</th>
                    </tr>
                    <tr>
                     <th>Address</th>   
                     <th>{{$shipping->address}}</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3 class="text-center text-success">Payment Info For This Order</h3>
                <table class="table table-bordered">
                    <tr>
                     <th>Payment Type</th>   
                     <th>{{$payment->payment_type}}</th>
                    </tr>
                    <tr>
                     <th>Payment Status</th>   
                     <th>{{$payment->payment_status}}</th>
                    </tr>
                    
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            
            <div class="panel-body">
                <h3 class="text-center text-success" id="xyz">Product Info for this Order</h3>
                <table class="table table-bordered">
                    <tr class="bg-primary">
                        <th>Sl No.</th>
                        <th>Product Id</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                        <th>Total Price</th>
                        
                    </tr>
                    @php($i=1)
                    @foreach($orderDetails as $orderDetail)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$orderDetail->product_id}}</td>
                        <td>{{$orderDetail->product_name}}</td>
                        <td>{{$orderDetail->product_price}}</td>
                        <td>{{$orderDetail->product_quantity}}</td>
                        <td>TK.{{$orderDetail->product_price*$orderDetail->product_quantity}}</td>
                        
                        
                        
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

@endsection