<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories=Category::latest();
        if(!empty($request->get('keyword'))){
            $categories=$categories->where('name','like','%'.$request->get('keyword').'%');
        }
        $categories=$categories->paginate(10);
        return view('admin.category.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'slug'=>'required|unique:categories',
        ]);

        if($validator->passes()){
            Category::addCategory($request);
            $request->session()->flash("success","Category added successfully");
            return response()->json([
                'status'=>true,
                'message'=>"Category added successfully"
            ]);

        }else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
//    public function show(Request)
//    {
//        return response()->json([
//            'status'=>true,
//            'message'=>"Category added successfully"
//        ]);
//    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category=Category::find($id);
        if(empty($category)){
            return redirect()->route('categories.index');
        }
        return view('admin.category.edit',['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'slug'=>'required|unique:categories,slug,'.$id.',id'
        ]);

        if($validator->passes()){
            Category::updateCategory($request,$id);
            $request->session()->flash("success","Category updated successfully");
            return response()->json([
                'status'=>true,
                'message'=>"Category updated successfully"
            ]);

        }else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=Category::find($id);
        if(empty($category)){
            return redirect()->route('categories.index');
        }
        if(file_exists(public_path().'/uploads/category/'.$category->image)){
            File::delete(public_path().'/uploads/category/'.$category->image);
        }
        if(file_exists(public_path().'/uploads/category/thumbnails/'.$category->image)){
            File::delete(public_path().'/uploads/category/thumbnails/'.$category->image);
        }
        $category->delete();
        session()->flash("success","Category deleted successfully");
        return response()->json([
            'status'=>true,
            'message'=>"Category deleted successfully"
        ]);

    }
}
