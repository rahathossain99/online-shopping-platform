<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $subCategories=SubCategory::select('sub_categories.*','categories.name as categoryName')
                        ->latest('id')
                        ->leftJoin('categories','categories.id','sub_categories.category_id');
        if(!empty($request->get('keyword'))){
            $subCategories=$subCategories->where('sub_categories.name','like','%'.$request->get('keyword').'%');
        }
        $subCategories=$subCategories->paginate(10);
        return view('admin.sub-category.index',['subCategories'=>$subCategories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::orderBy('name','ASC')->get();
        return view('admin.sub-category.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'category_id'=>'required',
            'name'=>'required',
            'slug'=>'required|unique:sub_categories',
            'status'=>'required'
        ]);

        if($validate->passes()){
            SubCategory::addSubCategory($request);
            $request->session()->flash('success','Subcategory added successfully');
            return response()->json([
                'status'=>true,
                'message'=>'Subcategory added successfully'
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
        $subCategory=SubCategory::find($id);
        $categories=Category::latest()->get();
        if(empty($subCategory)){
            return redirect()->route('sub-categories.index');
        }
        return view('admin.sub-category.edit',[
            'subCategory'=>$subCategory,
            'categories'=>$categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subCategory=SubCategory::find($id);

        if(empty($subCategory)){
            $request->session()->flash('error','Record not found');
            return response()->json([
                'status'=>false,
                'notFound'=>true
            ]);
        }else{
            $validate=Validator::make($request->all(),[
                'category_id'=>'required',
                'name'=>'required',
                'slug'=>'required|unique:sub_categories,slug,'.$subCategory->id.',id',
                'status'=>'required'
            ]);

            if($validate->passes()){
                SubCategory::updateSubCategory($request,$id);
                $request->session()->flash('success','Subcategory updated successfully');
                return response()->json([
                    'status'=>true,
                    'message'=>'Subcategory updated successfully'
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
    public function destroy(Request $request,string $id)
    {
        $subCategory=SubCategory::find($id);
        if(empty($subCategory)){
            $request->session()->flash('error','Record not found');
            return response()->json([
                'message'=>'Record not found'
            ]);
        }
        $subCategory->delete();
        $request->session()->flash("success","Subcategory deleted successfully");
        return response()->json([
            'status'=>true,
            'message'=>"Subcategory deleted successfully"
        ]);
    }
}
