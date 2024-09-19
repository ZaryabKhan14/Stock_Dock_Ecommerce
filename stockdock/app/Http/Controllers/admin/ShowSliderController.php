<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class ShowSliderController extends Controller
{
    public function show_slider_page(){
        $slider_data = Slider::all();
        return view('admin.show_slider',compact('slider_data'));
    }

    public function delete_slider($id){
        $delete_slider = Slider::find($id);
        $delete_slider->delete();
        return redirect()->route('show_slider_page');
    }


    public function edit_slider_page($id){
        $edit_slider = Slider::find($id);
        return view('admin.edit_slider_form',compact('edit_slider'));
    }
    

    public function update_slider(Request $request,$id){
        $update_slider = Slider::find($id);

        if ($request->hasFile('image')) {
            $path = 'admin_assets/slider_image';
            
                $imagePath = $request->file('image')->store($path, 'public');
                $update_slider->image = $imagePath;
            
        } else {
            return back()->withErrors(['image' => 'No image uploaded.']);
        }

        $update_slider->description = $request->input('description');
        $update_slider->title = $request->input('title');
        $update_slider->save();
        return redirect()->route('show_slider_page');
    }
}
