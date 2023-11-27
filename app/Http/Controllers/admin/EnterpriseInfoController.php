<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\EnterpriseInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EnterpriseInfoController extends Controller
{
    public function set()
    {
        $countries=Country::all();
        $info=EnterpriseInfo::find(1);
        return view('admin.enterprise-info.create-update',[
            'countries'=>$countries,
            'info'=>$info
        ]);
    }
    public function storeOrUpdate(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'country'=>'required',
            'city'=>'required',
            'zip'=>'required',
            'email'=>'required',
            'mobile'=>'required'
        ]);

        if($validator->passes()){
            $info=EnterpriseInfo::find(1);
            if(empty($info))
            {
                $info=new EnterpriseInfo();
            }
            $info->country=$request->country;
            $info->city=$request->city;
            $info->zip=$request->zip;
            $info->email=$request->email;
            $info->mobile=$request->mobile;
            $info->street=$request->street;
            $info->save();
            return redirect()->route('enterprise.info')->with('success','Enterprise information set successfully');

        }else{
            return redirect()->route('enterprise.info')
                    ->withErrors($validator)
                    ->withInput($request->all());
        }
    }
}
