<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Orders_items;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    public function show_checkout_form(){

        $cart = session()->get('cart', []);
        $subtotal = 0;
        $total = 0;
    
        foreach($cart as $cartItem) {
            $subtotal += $cartItem['price'] * $cartItem['quantity'];
            $total += $cartItem['price'] * $cartItem['quantity'];
        }
    
        $gst = $subtotal * 0.18;
        $deliveryCharges = 200; // Example delivery charges
        $total = $subtotal + $gst + $deliveryCharges;
    
     
        return view('user.checkout',compact('cart', 'subtotal', 'total', 'gst', 'deliveryCharges'));
    }


    public function process_checkout(Request $request){

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to continue.');

        }

        $cart = session()->get('cart');

        if (empty($cart)) {
            return redirect()->route('add_to_cart_view')->with('error', 'Your cart is empty.');

        }

        // Calculate total amount
        $totalAmount = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        $order = new Orders();
        $order->user_id = $user->id;
        $order->first_name = $request->input('f_name');
        $order->last_name = $request->input('l_name');
        $order->email = $request->input('email');
        $order->address = $request->input('shipping_address');
        $order->delivery_note = $request->input('note');
        $order->city = $request->input('city');
        $order->phone = $request->input('phone');
        $order->total_amount = $totalAmount; // Assign the calculated total amount
        $order->payment_method = $request->input('payment_method');

        $order->save();


        foreach ($cart as $item) {
            $order_item = new Orders_items();
            $order_item->order_id =$order->id;
            $order_item->product_id = $item['id'];
            $order_item->quantity = $item['quantity'];
            $order_item->price = $item['price'];
            $order_item->color = $item['color'];

            $order_item->save();
        }

        // Clear the cart after order is processed
        session()->forget('cart');

        return redirect()->route('user_Dashboard')->with('success', 'Your order has been placed successfully!');

    }
}
