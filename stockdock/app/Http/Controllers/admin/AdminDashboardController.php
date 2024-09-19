<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Orders;

class AdminDashboardController extends Controller
{
    public function admin_dashboard(){
        $total_user = User::count();
        $total_admin = User::where('role','admin')->count();
        $total_customer = User::where('role','user')->count();
        $total_order = Orders::count();
        $total_earning_amount = Orders::sum('total_amount');
      
        return view('admin.admin_dashboard',compact('total_user','total_admin','total_customer','total_order','total_earning_amount'));
        }   
}
