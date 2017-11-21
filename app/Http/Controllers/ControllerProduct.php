<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\facades\schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Product;
use App\Basket;

class ControllerProduct extends Controller
{
     public static function get_product() {
          $products = Product::all();
          //dd($products);
          return view('home', ['products' => $products]);
     }

    public static function add_product() {
          $request = request();
          $product = new Product;
          $product-> product_name = $request['product_name'];
          $product-> price = $request['price'];
          $product->save();
          return redirect()->action('ControllerProduct@get_product');
    }

    public static function delete_product($id) {
         $product = Product::where('product_id',$id)->first();
         $basket = Basket::where('product_id', $id)->first();
         //dd($product);
         $product->delete();

         if($basket !== null) {
             $basket->delete();
        };
         return view('delete');
         //return redirect()->action('ControllerProduct@get_product');
    }

    public static function get_info_product($id) {
         $products = Product::where('product_id', $id)->first();
        // dd($product);
         return view('edit', ['product' => $products]);
    }

    public static function update_product($id) {
         //dd($id);
         $request = request();
         $product = Product::where('product_id' , $id)->first();
         $product -> product_name  = $request['product_name'];
         $product -> price  = $request['product_price'];
         //dd($product);
         $product->save();
          return redirect()->action('ControllerProduct@get_product');
    }


}
