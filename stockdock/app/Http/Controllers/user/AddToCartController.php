<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class AddToCartController extends Controller
{
    public function add_to_cart_view(){
        return view('user.add_to_cart');
    }

    public function add_to_cart_product(Request $request) {

        if (!Auth::check()) {
            // If not authenticated, redirect to the login page
            return response()->json(['error' => 'You must be logged in to add items to the cart.'], 401);
        }
        $product_id = $request->input('id');
        $quantity = $request->input('quantity', 1);
        $color = $request->input('color'); // Get the selected color from request
    
        // Validate quantity
        if ($quantity <= 0) {
            return response()->json(['error' => 'Invalid quantity'], 400);
        }
    
        $product = Product::find($product_id);
    
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    
        $cart = session()->get('cart', []);
    
        // Create a unique key for each product-color combination
        $cartKey = $product_id . '_' . $color;
    
        // Update or add new item to the cart
        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $quantity;
        } else {
            $cart[$cartKey] = [
                'id' => $product->id,
                'name' => $product->product_name,
                'price' => $product->product_price,
                'color' => $color, // Set the selected color
                'quantity' => $quantity,
                'poster' => $product->product_images
            ];
        }
    
        session()->put('cart', $cart);
    
        // Calculate total quantity
        $totalQuantity = array_sum(array_column($cart, 'quantity'));
    
        return response()->json(['message' => 'Cart updated', 'cartCount' => $totalQuantity], 200);
    }
    


    public function deleteItem(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Items successfully deleted.');
        
        }
    }
}
