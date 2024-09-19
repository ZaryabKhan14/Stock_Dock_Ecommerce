<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ShowUserController extends Controller
{
    public function show_user(){
        $show_user = User::all();
        return view('admin.show_user',compact('show_user'));
    }

    public function delete_user($id){
        $delete_user = User::find($id);
        $delete_user->delete();
        return redirect()->route('show_user');
    }

    public function edit_user_form($id){
        $edit_user = User::find($id);
        return view('admin.edit_user',compact('edit_user'));
    }

    public function update_user(Request $request,$id){
        $edit_user = User::find($id);
        $edit_user->name =$request->input('name'); 
        $edit_user->email =$request->input('email'); 
        $edit_user->password = bcrypt($request->input('password'));
        $edit_user->role =$request->input('role'); 
        $edit_user->save();
        return redirect()->route('show_user');
    }
}
