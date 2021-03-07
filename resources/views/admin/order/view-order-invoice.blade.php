@extends('admin.master')
@section('body')
<br/>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="text-center text-success">View Order Invoice Form</h4>
            </div>
            <div class="panel-body">
                <head>
<meta charset='UTF-8'>
<title>Editable Invoice</title>
<link rel='stylesheet' href="{{asset('/')}}admin/css/style.css">
<link rel='stylesheet' href="{{asset('/')}}admin/css/print.css">

</head>
<body>
<div id="page-wrap">
<textarea id="header">INVOICE</textarea>
<div id="identity">
<u><h4>Shipping Info</h4></u>
<textarea id="address">
    Name: {{$shipping->full_name}}
    Address: {{$shipping->address}}
    Phone Number: {{$shipping->phone_number}}
 </textarea>
    
<u><h4>Billing Info</h4></u>
<textarea id="address">
    Name: {{$customer->first_name.' '.$customer->last_name}}
    Address: {{$customer->address}}
    Phone No: {{$customer->phone_number}}
</textarea>
<div id="logo">
<div id="logoctr">
<a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>
<a href="javascript:;" id="save-logo" title="Save changes">Save</a>
|
<a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>
<a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>
</div>
<div id="logohelp">
<input id="imageloc" type="text" size="50" value="" /><br />
(max width: 540px, max height: 100px)
</div>
<img id="image" src="{{asset('/')}}admin/images/logo.png" alt="logo" />
</div>
</div>
<div style="clear:both"></div>
<div id="customer">
<textarea id="customer-title">Widget Corp.
c/o Steve Widget</textarea>
<table id="meta" class="">
<tr>
<td class="meta-head">Invoice #</td>
<td><textarea>{{$order->id}}</textarea></td>
</tr>
<tr>
<td class="meta-head">Date</td>
<td><textarea id="date">{{$customer->created_at}}</textarea></td>
</tr>
<tr>
<td class="meta-head">Amount Due</td>
<td><div class="due">Tk. {{$order->order_total}}</div></td>
</tr>
</table>
</div>
<table id="items">
<tr>
<th>Item</th>
<th>Description</th>
<th>Unit Cost</th>
<th>Quantity</th>
<th>Price</th>
</tr>
@php($sum=0)
@foreach($orderDetails as $orderDetail)
<tr class="item-row">
   
<td class="item-name"><div class="delete-wpr"><textarea>{{$orderDetail->product_name}}</textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div>
</td>
<td class="description"><textarea></textarea></td>
<td><textarea class="cost">{{$orderDetail->product_price}}</textarea></td>
<td><textarea class="qty">{{$orderDetail->product_quantity}}</textarea></td>
<td><span class="price"></span>Tk.{{$total=$orderDetail->product_price*$orderDetail->product_quantity}}</td>

</tr>
@php($sum=$sum+$total)
@endforeach



<tr>
<td colspan="2" class="blank"> </td>
<td colspan="2" class="total-line">Total:</td>
<td class="total-value"><div id="total">Tk. {{$sum}}</div></td>
</tr>

</table>
<div id="terms">
 <h5>Terms</h5>
<textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
</div>
</div>
</body>
            </div>
        </div>
    </div>
</div>


@endsection