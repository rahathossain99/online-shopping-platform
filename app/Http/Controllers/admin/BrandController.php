<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $brands=Brand::latest();
        if(!empty($request->get('keyword'))){
            $brands=$brands->where('name','like','%'.$request->get('keyword').'%');
        }

        $brands=$brands->paginate('10');
        return view('admin.brand.index',['brands'=>$brands]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'name'=>'required',
            'slug'=>'required|unique:brands',
            'status'=>'required'
        ]);

        if($validate->passes()){
            Brand::addBrand($request);
            $request->session()->flash('success','Brand added successfully');
            return response()->json([
                'status'=>true,
                'message'=>'Brand added successfully'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'errors'=>$validate->errors()
            ]);
        }



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand=Brand::find($id);
        if(empty($brand)){
            return redirect()->route('brands.index');
        }
        return view('admin.brand.edit',['brand'=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand=Brand::find($id);
        if(empty($brand)){
            $request->session()->flash('error','Record not found');
            return response()->json([
                'status'=>false,
                'notFound'=>true
            ]);
        }else{
            $validate=Validator::make($request->all(),[
                'name'=>'required',
                'slug'=>'required|unique:brands,slug,'.$brand->id.',id',
                'status'=>'required'
            ]);

            if($validate->passes()){
                Brand::updateBrand($request,$id);
                $request->session()->flash('success','Brand updated successfully');
                return response()->json([
                    'status'=>true,
                    'message'=>'Brand updated successfully'
                ]);
            }else{
                return response()->json([
                    'status'=>false,
                    'notFound'=>true,
                    'errors'=>$validate->errors()
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,Request $request)
    {
        $brand=Brand::find($id);
        if(empty($brand)){
            $request->session()->flash('error','Record not found');
            return response()->json([
                'message'=>'Record not found'
            ]);
        }
        $brand->delete();
        $request->session()->flash("success","Brand deleted successfully");
        return response()->json([
            'status'=>true,
            'message'=>"Brand deleted successfully"
        ]);
    }
}
