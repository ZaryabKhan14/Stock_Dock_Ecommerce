<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Slider;
use App\Models\Product;

class UserDashboardController extends Controller
{
    public function user_Dashboard(){
        $show_slider_data = Slider::all();
        $show_product_data = Product::paginate(6);
        return view('user.user_dashboard',compact('show_slider_data','show_product_data'));
        
    }   
    
}
