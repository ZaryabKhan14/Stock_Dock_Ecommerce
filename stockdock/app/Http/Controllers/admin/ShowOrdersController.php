<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Orders_items;
class ShowOrdersController extends Controller
{
    public function show_customer_orders(){

        $order_fetch = Orders::with('items.product')->get();
        return view('admin.show_orders',compact('order_fetch'));
    }
}
