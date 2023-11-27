<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function changePassword()
    {
        return view('admin.change-password');
    }
    public function changePasswordProcess(Request $request)
    {
        $user=Auth::guard('admin')->user();
        $validate=Validator::make($request->all(),[
            'old_password'=>'required',
            'new_password'=>'required|min:5',
            'confirm_password'=>'required|same:new_password',
        ]);
        if($validate->passes())
        {
            if(Hash::check($request->old_password,$user->password))
            {
                $user->password=Hash::make($request->new_password);
                $user->save();
                return redirect()->route('admin.dashboard')->with('success','Your password is changed successfully.');
            }else{
                return redirect()->route('admin.changePassword')->with('error','Your old password is incorrect,please try again.');
            }
        }else{
            return redirect()->route('admin.changePassword')->withErrors($validate);
        }

    }
}
