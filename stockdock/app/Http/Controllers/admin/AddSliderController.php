<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class AddSliderController extends Controller
{
    public function add_slider_form(){
        return view('admin.add_slider');
    }

    public function add_slider(Request $request)
{
    $add_slider = new Slider;

    if ($request->hasFile('image')) {
        $path = 'admin_assets/slider_image';
        try {
            $imagePath = $request->file('image')->store($path, 'public');
            $add_slider->image = $imagePath;
        } catch (\Exception $e) {
            return back()->withErrors(['image' => 'Failed to upload image.']);
        }
    } else {
        return back()->withErrors(['image' => 'No image uploaded.']);
    }

    $add_slider->title = $request->input('title');
    $add_slider->description = $request->input('description');
    $add_slider->save();

    return redirect()->route('admin')->with('success', 'Slider added successfully');
}

}
    