<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users=User::latest();
        if(!empty($request->get('keyword')))
        {
            $users=$users->where('name','like','%'.$request->get('keyword').'%');
            $users=$users->orWhere('email','like','%'.$request->get('keyword').'%');
        }
        $users=$users->paginate(10);
        return view('admin.user.index',['users'=>$users]);
    }
    public function edit($id)
    {
        $user=User::find($id);
        if(empty($user))
        {
            return redirect()->route('users.index')->with('error','Records Not Found');
        }
        return view('admin.user.edit',['user'=>$user]);
    }
    public function update($id,Request $request)
    {
        $user=User::find($id);
//        dd($user);
        if(empty($user))
        {
            return redirect()->route('users.index')->with('error','Records Not Found');
        }
        $validate=Validator::make($request->all(),[
            'name'=>'required|min:5',
            'email'=>'required|email',
        ]);
        if (($validate->passes()))
        {
            $user->name=$request->name;
            $user->email=$request->email;
            $user->phone=$request->phone;
            $user->status=$request->status;
            $user->save();
            return redirect()->route('users.index')->with('success','User updated successfully');
        }else{
            return redirect()->route('users.edit',$user->id)
                ->withErrors($validate)
                ->withInput($request->all());
        }

    }
    public function destroy($id,Request $request)
    {
       $user=User::find($id);
       if(empty($user))
       {
           return redirect()->route('users.index')->with('error','Records Not Found');
       }else{
           $user->delete();
           $request->session()->flash('success','User deleted successfully');
           return response()->json([
               'status'=>true
           ]);
       }
    }
}

