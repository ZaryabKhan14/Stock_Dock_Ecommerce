<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class AddProductController extends Controller
{
    public function add_product_form()
    {
        return view('admin.add_product');
    }

    public function add_product(Request $request){

        $add_product = new Product();
        $add_product->product_name = $request->input('product_name');
        $add_product->product_description = $request->input('product_description');
        $add_product->product_price = $request->input('product_price');
        $add_product->product_quantity = $request->input('product_quantity');
        // Store multiple colors as JSON
        $colors = $request->input('product_colour'); // Assuming this is an array
        $add_product->product_colour = json_encode($colors); // Convert array to JSON        // $add_product->product_video = $request->input('product_video');

        // Handle image uploads
    $images = [];
    if ($request->hasfile('product_images')) {
        foreach ($request->file('product_images') as $image) {
            $name = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('product_images'), $name);
            $images[] = $name; // Store image name in the array
        }
    }
    $add_product->product_images = json_encode($images);

    // // Handle video upload
    // $videoPath = null;
    // if ($request->hasFile('product_video')) {
    //     $video = $request->file('product_video');
    //     $videoPath = $video->store('product_video', 'public'); // Save the video to the 'public/videos' directory
    // }

    
        $add_product->save();
        return redirect()->route('admin')->with('message','Product added successfully');

    }
}