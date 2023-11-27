<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductImageController extends Controller
{
    public function destroy($id){

        $productImage=ProductImage::find($id);
        if(empty($productImage))
        {
            return response()->json([
                'status'=>false,
                'message'=>'Image not found'
            ]);
        }
        else
        {
            $smPath=public_path().'/uploads/product/small/'.$productImage->image;
            $slPath=public_path().'/uploads/product/large/'.$productImage->image;

            if(file_exists($smPath))
            {
                File::delete($smPath);
            }
            if (file_exists($slPath))
            {
                File::delete($slPath);
            }

            $productImage->delete();
            return response()->json([
                'status'=>true,
                'message'=>'Image deleted successfully'
            ]);
        }
    }
}
