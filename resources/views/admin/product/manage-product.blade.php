@extends('admin.master')
@section('body')
<br/>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="text-center text-success ">Manage Product Form</h4>
            </div>
            <div class="panel-body">
            	<h3 class="text-center text-success" id="xyz">{{Session::get('message')}}</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                    <tr class="bg-primary">
                        <th>Sl No.</th>
                        <th>Category Name</th>
                        <th>Brand Name</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                        <th>publication Status</th>
                        <th>Action</th>
                    </tr>
                    @php($i=1)
                    @foreach($products as $product)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$product->category_name}}</td>
                        <td>{{$product->brand_name}}</td>
                        <td>{{$product->product_name}}</td>
                        <td>
                            <img src="{{asset($product->product_image)}}" height="100" width="100">
                        </td>
                        <td>{{$product->product_price}}</td>
                        <td>{{$product->product_quantity}}</td>
                        <td>{{$product->publication_status}}</td>
                        <td>
                            <a href="" class="btn btn-info btn-xs" title="View Details">
                                <span class="glyphicon glyphicon-zoom-in"></span>
                            </a>
                            <a href="" class="btn btn-primary btn-xs" title="Published">
                                <span class="glyphicon glyphicon-arrow-up"></span>
                            </a>
                            <a href="{{route('edit-product',['id'=>$product->id])}}" class="btn btn-success btn-xs">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                            <a href="" class="btn btn-danger btn-xs">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                            
                        </td>
                    </tr>
                    @endforeach
                    
                    
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection