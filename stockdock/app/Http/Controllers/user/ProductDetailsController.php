<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductDetailsController extends Controller
{
    public function show_product_details($id){

        $product_details = Product::find($id);
        if (!$product_details) {
            // Handle the case where the product is not found
            return abort(404, 'Product not found');
        }
        $product_details->product_images = json_decode($product_details->product_images);
        $product_details->product_colour = json_decode($product_details->product_colour);

        return view('user.product_details',compact('product_details'));
    }


    public function all_product(){

        $all_product = Product::paginate(10);

        foreach ($all_product as $product) {
            $product->product_colour = json_decode($product->product_colour, true) ?? [];
        }

            return view('user.all_products',compact('all_product'));

    }
}