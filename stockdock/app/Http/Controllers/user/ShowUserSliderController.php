<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class ShowUserSliderController extends Controller
{
    public function show_slider(){
        $show_slider_data = Slider::all();
        return view('user.user_dashboard',compact('show_slider_data'));
    }
    
}
