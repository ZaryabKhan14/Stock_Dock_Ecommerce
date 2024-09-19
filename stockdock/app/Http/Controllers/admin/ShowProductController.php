<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ShowProductController extends Controller
{
    public function show_product_page()
    {
        // Retrieve all products from the database
        $products = Product::all();

        if ($products->isEmpty()) {
            // If no products are found, handle it appropriately
            return view('admin.show_product')->with('products', []);
        }

        // Decode JSON images for each product
        foreach ($products as $product) {
            $product->decoded_images = json_decode($product->product_images, true);
        }

        // Pass the products to the view
        return view('admin.show_product', compact('products'));
    }

    public function delete_product($id){
        $product_delete = Product::find($id);
        $product_delete->delete();
        return redirect()->route('show_product_page')->with('message','Product deleted successfully');
    }


    public function edit_product_form($id){

        $product_edit = Product::find($id);
        return view('admin.edit_product',compact('product_edit'));
    }


    public function update_product(Request $request,$id){

        $product_update = Product::find($id);
        $product_update->product_name = $request->input('product_name');
        $product_update->product_description = $request->input('product_description');
        $product_update->product_price = $request->input('product_price');
        $product_update->product_quantity = $request->input('product_quantity');
        // $product_update->product_video = $request->input('product_video');

        // Handle image uploads
    $images = [];
    if ($request->hasfile('product_images')) {
        foreach ($request->file('product_images') as $image) {
            $name = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('product_images'), $name);
            $images[] = $name; // Store image name in the array
        }
    }
    $product_update->product_images = json_encode($images);

    // // Handle video upload
    // $videoPath = null;
    // if ($request->hasFile('product_video')) {
    //     $video = $request->file('product_video');
    //     $videoPath = $video->store('product_video', 'public'); // Save the video to the 'public/videos' directory
    // }

    
        $product_update->save();
        return redirect()->route('show_product_page')->with('message','Product updated successfully');
    }
}
