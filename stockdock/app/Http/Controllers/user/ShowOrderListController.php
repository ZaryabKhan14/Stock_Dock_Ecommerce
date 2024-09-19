<?php

namespace App\Http\Controllers\user;
use App\Models\Orders;
use App\Models\Orders_items;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowOrderListController extends Controller
{
    public function show_user_orders(){

        $user = Auth::User();
        $orders_fetch = Orders::where('user_id',$user->id)->with('items.product')->get();

        return view('user.user_order_list', compact('orders_fetch'));

    }
}
