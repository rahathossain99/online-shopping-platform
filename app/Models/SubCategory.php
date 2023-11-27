<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SubCategory extends Model
{
    use HasFactory;

    public static function addSubCategory(Request $request){
        $subCategory=new SubCategory();
        $subCategory->name=$request->name;
        $subCategory->slug=$request->slug;
        $subCategory->status=$request->status;
        $subCategory->category_id=$request->category_id;
        if(!empty($request->showhome))
        {
            $subCategory->show_home=$request->showhome;
        }
        $subCategory->save();
    }


    public static function updateSubCategory(Request $request,$id){
        $subCategory=SubCategory::find($id);
        $subCategory->name=$request->name;
        $subCategory->slug=$request->slug;
        $subCategory->status=$request->status;
        $subCategory->category_id=$request->category_id;
        if(!empty($request->showhome))
        {
            $subCategory->show_home=$request->showhome;
        }
        $subCategory->save();
    }
}
