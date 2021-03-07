<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class NewShopController extends Controller
{
    public function index() {
    	$categories=Category::where('publication_status',1)->get();
    	$newProducts=Product::where('publication_status',1)->orderBy('id','DESC')->take(8)->get();

    	//return $newProducts;

        return view('front-end.home.home',
        ['categories'=>$categories,
        	'newProducts'=>$newProducts
    ]);
    }

    public function categoryProduct($id) {
    	// $categoryProducts=Product::where('category_id',$id)
      // ->where('publication_status',1)
      // ->get();
      //$categories=Category::where('publication_status',1)->get();
      $categoryProducts=Product::where('category_id',$id)
      ->where('publication_status',1)->get();
        return view('front-end.category.category-content',[
          'categoryProducts'=>$categoryProducts
        ]);
    }
    public function productDetails($id){
      $product=Product::find($id);
      return view('front-end.product.product-details',['product'=>$product]);
    }
}
