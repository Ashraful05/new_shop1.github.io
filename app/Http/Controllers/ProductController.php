<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Brand;
use DB;
use Image;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::where('publication_status',1)->get();
        $brands=Brand::where('publication_status',1)->get();

        return view('admin.product.add-product',[
            'categories'=>$categories,
            'brands'=>$brands
        ]);
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
    protected function productInfoValidate($request)
    {
                $this->validate($request,[
                    'product_name' => 'required'
        ]);
    }

    protected function productImageUpload($request)
    {
                $productImage=$request->file('product_image');
                $fileType=$productImage->getClientOriginalExtension();
        $imageName=$request->product_name.'.'.$fileType;
        $directory='product-images/';
        $imageUrl=$directory.$imageName;
        //$productImage->move($directory,$imageName);
        Image::make($productImage)->resize(200,200)->save($imageUrl);
        return $imageUrl;
    }

    protected function saveProductBasicInfo($request,$imageUrl)
    {
     $product=new Product();
        $product->category_id=$request->category_id;
        $product->brand_id=$request->brand_id;
        $product->product_name=$request->product_name;
        $product->product_price=$request->product_price;
        $product->product_quantity=$request->product_quantity;
        $product->short_description=$request->short_description; 
        $product->long_description=$request->long_description; 
        $product->product_image=$imageUrl; 
        $product->publication_status=$request->publication_status; 

        $product->save();   
    }

    public function saveProduct(Request $request)
    {
        $this->productInfoValidate($request);
        $imageUrl = $this->productImageUpload($request);
        $this->saveProductBasicInfo($request,$imageUrl);


        return redirect('/product/add')->with('message','Product Info saved successfully');


       // return $imageName;
        
        // $product=new Product();
        // $product->product_image=$imageUrl;
    }

    public function manageProduct(){
        $products=DB::table('products')->join('categories','products.category_id','=','categories.id')->join('brands','products.brand_id','=','brands.id')->select('products.*','categories.category_name','brands.brand_name')->get();


        //return $products;

        return view('admin.product.manage-product',['products'=>$products]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function editProduct($id)
    {
        $product=Product::find($id);
        $categories=Category::where('publication_status',1)->get();
        $brands=Brand::where('publication_status',1)->get();
        return view('admin.product.edit-product',
            [
            'product'=>$product,
            'categories'=>$categories,
            'brands'=>$brands
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function productBasicInfoUpdate($product,$request,$imageUrl=null){

        $product->category_id=$request->category_id;
        $product->brand_id=$request->brand_id;
        $product->product_name=$request->product_name;
        $product->product_price=$request->product_price;
        $product->product_quantity=$request->product_quantity;
        $product->short_description=$request->short_description; 
        $product->long_description=$request->long_description; 
        if($imageUrl){
        $product->product_image=$imageUrl;
    }
        //$product->product_image=$imageUrl; 
        $product->publication_status=$request->publication_status;
        $product->save();
    }

    public function updateProduct(Request $request)
    {
        //return $request->all();
        // $productImage=$_FILES['product_image'];
        // echo '<pre>';
        // print_r($productImage);
        $productImage=$request->file('product_image');
        $product=Product::find($request->product_id);

        if($productImage){
            unlink($product->product_image);

            $imageUrl = $this->productImageUpload($request);
            $this->productBasicInfoUpdate($product,$request,$imageUrl);

         
        // return redirect('/product/manage')->with('message','Product Info Updated');
        //return $imageUrl;

        }else{
            //$product=Product::find($request->product_id);        
        //     $product->category_id=$request->category_id;
        // $product->brand_id=$request->brand_id;
        // $product->product_name=$request->product_name;
        // $product->product_price=$request->product_price;
        // $product->product_quantity=$request->product_quantity;
        // $product->short_description=$request->short_description; 
        // $product->long_description=$request->long_description; 
        // //$product->product_image=$imageUrl; 
        // $product->publication_status=$request->publication_status; 

        // $product->save();  
            $this->productBasicInfoUpdate($product,$request);

       
        }
         return redirect('/product/manage')->with('message','Product Info Updated');

        //echo $productImage;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
