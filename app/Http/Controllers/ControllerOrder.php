<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Basket;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\facades\schema;
use Illuminate\Support\Facades\Session;
use App\Order;

class ControllerOrder extends Controller
{
    public static function buy_product() {
         $id = $_POST['id'];
         $user_id = $_POST['user'];
         $order = new Basket;
         $order -> product_id = $id;
         $order -> user_id = $user_id;
         $order->save();
         return redirect()->action('ControllerProduct@get_product');
    }

    public static function review_order() {

         $user_id = Auth::User() -> id;
         $order = Basket::leftJoin( 'products' ,'baskets.product_id', '=', 'products.product_id')->where('user_id', $user_id)->get();
//dd($order);
          $price = [];

         foreach ($order as  $prices ) {

              $price[] = $prices->price;
         }
         $total_value = 0;
         foreach ($price as $key => $value) {
              $total_value += $value;
         }
         //dd($total_value);

          //$total_price = $order=>[price];
        // dd($total_price);

         //$order = Basket::with('Product')->get

         return view('basket', ['products'=>$order], ['total_price'=> $total_value]);
    }

    public static function delete_from_basket($id) {
          $request = request();
          $order = Basket::where('product_id', $id)->first();
          //dd($order);
          $order->delete();
          return redirect ()->action('ControllerOrder@review_order');
    }

    public static function place_order() {
         $id = Auth::User() -> id;
         $request = request();
         $order = new Order;
         $order-> user_id = $id;
         $order-> Company_name = $request['company_name'];
         $order-> address_street = $request['street_address'];
         $order-> address_city = $request['city_address'];
        $order-> address_postcode = $request['postcode_address'];
        $order-> status = $request['status'];
        $order -> total_price = $request['total_price'];
        $order->save();
        //return redirect()->action('ControllerOrder@overwiev_order');
        return view('submit_order');
    }
/*
    public static function overwiev_order() {
         return view('submit_order');
    }
*/
    public static function placed_order_review() {
         $id = Auth::User() -> id;
         $review = Basket::leftJoin( 'products' ,'baskets.product_id', '=', 'products.product_id')->where('user_id', $id)->get();
         $order = Order::where('user_id', $id)->first();
         //dd($order);
         return view('orderoverview',['reviews'=>$review], ['order'=>$order]);

         //return redirect()->action('ControllerOrder@placed_order_review',['order'=>$order], ['review'=>$review]);
    }


}
