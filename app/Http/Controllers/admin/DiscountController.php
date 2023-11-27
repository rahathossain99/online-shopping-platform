<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{
    public function index(Request $request)
    {
        $coupons=DiscountCoupon::latest();
        if(!empty($request->get('keyword')))
        {
            $coupons=$coupons->where('name','like','%'.$request->get('keyword').'%');
        }
        $coupons=$coupons->paginate(10);
        return view('admin.coupon.index',[
            'coupons'=>$coupons
        ]);
    }

    public function create()
    {
        return view('admin.coupon.create');
    }
    public function store(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'discount_amount'=>'required',
            'type'=>'required',
            'status'=>'required'
        ]);
        if($validate->passes())
        {
            $coupon=new DiscountCoupon();
            $coupon->code=$request->code;
            $coupon->name=$request->name;
            $coupon->description=$request->description;
            $coupon->max_uses=$request->max_uses;
            $coupon->max_uses_user=$request->max_uses_user;
            $coupon->type=$request->type;
            $coupon->discount_amount=$request->discount_amount;
            $coupon->min_amount=$request->min_amount;
            $coupon->status=$request->status;
            $coupon->starts_at=$request->starts_at;
            $coupon->expires_at=$request->expires_at;
            $coupon->save();
            $request->session()->flash('success','Coupon added successfully');
            return response()->json([
                'status'=>true,
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'error'=>$validate->errors()
            ]);
        }
    }
    public function edit(Request $request,$id)
    {
        $coupon=DiscountCoupon::find($id);
        if(empty($coupon))
        {
            $request->session()->flash('error','Records Not Found');
            return redirect()->route('coupons.index');
        }
        return view('admin.coupon.edit',[
            'coupon'=>$coupon
        ]);

    }
    public function update(Request $request,$id)
    {
        $validate=Validator::make($request->all(),[
            'discount_amount'=>'required',
            'type'=>'required',
            'status'=>'required'
        ]);
        if($validate->passes())
        {
            $coupon=DiscountCoupon::find($id);
            if(empty($coupon))
            {
                $request->session()->flash('error','Records Not Found');
                return response()->json([
                    'status'=>true,
                    'message'=>'Records Not Found'
                ]);
            }
            $coupon->code=$request->code;
            $coupon->name=$request->name;
            $coupon->description=$request->description;
            $coupon->max_uses=$request->max_uses;
            $coupon->max_uses_user=$request->max_uses_user;
            $coupon->type=$request->type;
            $coupon->discount_amount=$request->discount_amount;
            $coupon->min_amount=$request->min_amount;
            $coupon->status=$request->status;
            $coupon->starts_at=$request->starts_at;
            $coupon->expires_at=$request->expires_at;
            $coupon->save();
            $request->session()->flash('success','Coupon updated successfully');
            return response()->json([
                'status'=>true,
                'message'=>'Coupon updated successfully'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'error'=>$validate->errors()
            ]);
        }
    }
    public function destroy(Request $request,$id)
    {
        $coupon=DiscountCoupon::find($id);
        if(empty($coupon))
        {
            $request->session()->flash('error','Records Not Found');
            return redirect()->route('coupons.index');
        }
        $coupon->delete();
        $request->session()->flash('success','Coupon deleted successfully');
        return response()->json([
            'status'=>true,
            'message'=>'Coupon deleted successfully'
        ]);
    }
}
