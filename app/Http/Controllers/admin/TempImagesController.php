<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Models\TempImage;
use Illuminate\Http\Request;

class TempImagesController extends Controller
{
    public function create(Request $request)
    {
        $image=$request->image;
        if(!empty($image))
        {
            $ext=$image->getClientOriginalExtension();
            $newName=time().'.'.$ext;

            $tempImage=new TempImage();
            $tempImage->name=$newName;
            $tempImage->save();
            $image->move(public_path().'/temp',$newName);

            //thumbnails generator
            $sPath=public_path().'/temp/'.$newName;
            $dPath=public_path().'/temp/thumb/'.$newName;
            $image=Image::make($sPath);
            $image->fit(300,275);
            $image->save($dPath);

            return response()->json([
                'status'=>true,
                'image_id'=>$tempImage->id,
                'imagePath'=>asset('/temp/thumb/'.$newName),
                'message'=>'Image uploaded successfully'
            ]);
        }
    }
}
