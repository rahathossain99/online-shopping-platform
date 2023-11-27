<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Brand extends Model
{
    use HasFactory;

    public static function addBrand(Request $request){
        $brand=new Brand();
        $brand->name=$request->name;
        $brand->slug=$request->slug;
        $brand->status=$request->status;
        $brand->save();
    }


    public static function updateBrand(Request $request,$id){
        $brand=Brand::find($id);
        $brand->name=$request->name;
        $brand->slug=$request->slug;
        $brand->status=$request->status;
        $brand->save();
    }
}
