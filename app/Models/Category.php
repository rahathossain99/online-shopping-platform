<?php

namespace App\Models;

use App\Models\TempImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    public static function addCategory(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        if(!empty($request->showHome))
        {
            $category->show_home = $request->showHome;
        }
        $category->save();

        //save image here
        if(!empty($request->image_id)){
            $tmpImage=TempImage::find($request->image_id);
            $tempArray=explode('.',$tmpImage->name);
            $ext=last($tempArray);
            $newImage=$category->id.'-'.time().'.'.$ext;
            $sPath=public_path().'/temp/'.$tmpImage->name;
            $dPath=public_path().'/uploads/category/'.$newImage;
            File::copy($sPath,$dPath);

            //generate thumbnail
            $dPath=public_path().'/uploads/category/thumbnails/'.$newImage;
            $img = Image::make($sPath);
            $img->fit(450,600,function ($constraint){
                $constraint->upsize();
            });
            $img->save($dPath);

            $category->image=$newImage;
            $category->save();
            File::delete($sPath);
            $tmpImage->delete();
        }
    }


    public static function updateCategory(Request $request,$id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        if(!empty($request->showHome))
        {
            $category->show_home = $request->showHome;
        }
        $category->save();

        //update image here
        if(!empty($request->image_id)){
            if(file_exists(public_path().'/uploads/category/'.$category->image)){
                File::delete(public_path().'/uploads/category/'.$category->image);
            }
            if(file_exists(public_path().'/uploads/category/thumbnails/'.$category->image)){
                File::delete(public_path().'/uploads/category/thumbnails/'.$category->image);
            }
            $tmpImage=TempImage::find($request->image_id);
            $tempArray=explode('.',$tmpImage->name);
            $ext=last($tempArray);
            $newImage=$category->id.'-'.time().'.'.$ext;
            $sPath=public_path().'/temp/'.$tmpImage->name;
            $dPath=public_path().'/uploads/category/'.$newImage;
            File::copy($sPath,$dPath);

            //generate thumbnail
            $dPath=public_path().'/uploads/category/thumbnails/'.$newImage;
            $img = Image::make($sPath);
            $img->resize(450,600);
            $img->save($dPath);

            $category->image=$newImage;
            $category->save();
            File::delete($sPath);
            $tmpImage->delete();
        }
    }


    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class);
    }
}

