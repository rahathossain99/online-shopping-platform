<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function League\Flysystem\delete;

class ShippingController extends Controller
{
    public function index(Request $request)
    {
        $shippingCharges=Shipping::select('shippings.*','countries.name')
            ->leftJoin('countries','countries.id','shippings.country_id');
        if(!empty($request->get('keyword')))
        {
            $shippingCharges=$shippingCharges->where('name','like','%'.$request->get('keyword').'%');
        }
        $shippingCharges=$shippingCharges->paginate(10);
        return view('admin.shipping.index',[
            'shippingCharges'=>$shippingCharges
        ]);
    }
    public function create()
    {
        $countries=Country::get();
        return view('admin.shipping.create',[
            'countries'=>$countries,

        ]);
    }

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'country'=>'required|unique:shippings,country_id',
            'amount'=>'required'
        ]);
        if($validator->passes())
        {
            $shipping=new Shipping();
            $shipping->country_id=$request->country;
            $shipping->amount=$request->amount;
            $shipping->save();
            $request->session()->flash('success',"Shipping is created successfully");
            return response()->json([
                'status'=>true,
            ]);

        }else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()
            ]);
        }
    }

    public function edit(Request $request,$id)
    {
        $countries=Country::get();
        $shippingCharge=Shipping::find($id);
        if(empty($shippingCharge))
        {
            $request->session()->flash('error',"Records Not Found");
            return redirect()->route('shippings.index');
        }
        return view('admin.shipping.edit',[
            'countries'=>$countries,
            'shippingCharge'=>$shippingCharge
        ]);
    }

    public function update($id,Request $request)
    {
        $shipping=Shipping::find($id);
        if(empty($shipping))
        {
            $request->session()->flash('error',"Records Not Found.\nSomething is wrong!");
            return response()->json([
                'status'=>true,
                'message'=>'Records Not Found'
            ]);
        }
        $validator=Validator::make($request->all(),[
            'country'=>'required',
            'amount'=>'required'
        ]);
        if($validator->passes())
        {

            $shipping->country_id=$request->country;
            $shipping->amount=$request->amount;
            $shipping->save();
            $request->session()->flash('success','Shipping updated successfully');
            return response()->json([
                'status'=>true,
                'message'=>'Shipping updated successfully'
            ]);

        }else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()
            ]);
        }
    }
    public function destroy($id,Request $request)
    {
        $shipping=Shipping::find($id);
        if(empty($shipping))
        {
            $request->session()->flash('error',"Records Not Found.\nSomething is wrong!");
            return response()->json([
                'status'=>false,
                'message'=>'Records Not Found'
            ]);
        }
        $shipping->delete();
        $request->session()->flash('success','Shipping deleted successfully');
        return response()->json([
            'status'=>true,
            'message'=>'Shipping deleted successfully'
        ]);

    }
}
