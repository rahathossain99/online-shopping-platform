<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class Product extends Model
{
    use HasFactory;

    public static function addProduct(Request $request)
    {
        $product=new Product();
        $product->title=$request->title;
        $product->slug=$request->slug;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->compare_price=$request->compare_price;
        $product->category_id=$request->category;
        $product->sub_category_id=$request->sub_category;
        $product->brand_id=$request->brand;
        $product->short_description=$request->short_description;
        $product->shipping_returns=$request->shipping_returns;
        $product->related_products=(!empty($request->related_products)) ? implode(",",$request->related_products) : '';
        $product->is_featured=$request->is_featured;
        $product->sku=$request->sku;
        $product->barcode=$request->barcode;
        $product->track_qty=$request->track_qty;
        $product->qty=$request->qty;
        $product->status=$request->status;
        $product->save();

        if(!empty($request->image_array))
        {
            foreach ($request->image_array as $temp_image_id)
            {
                $productImage=new ProductImage();
                $productImage->product_id=$product->id;
                $productImage->image='NULL';
                $productImage->save();

                $tempImage=TempImage::find($temp_image_id);
                $extArray=explode('.',$tempImage->name);
                $ext=last($extArray);
                $newImage=$product->id.'-'.$productImage->id.'-'.time().'.'.$ext;
                $productImage->image=$newImage;
                $productImage->save();

                $sPath=public_path().'/temp/'.$tempImage->name;
                $dPath=public_path().'/uploads/product/large/'.$newImage;
                $image=Image::make($sPath);
                $image->resize(1400,null,function ($constraint){
                    $constraint->aspectRatio();
                });
                $image->save($dPath);

                $dPath=public_path().'/uploads/product/small/'.$newImage;
                $image=Image::make($sPath);
                $image->fit(300,300);
                $image->save($dPath);
            }

        }
    }

    public static function updateProduct(Request $request,$id)
    {
        $product=Product::find($id);

        $product->title=$request->title;
        $product->slug=$request->slug;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->compare_price=$request->compare_price;
        $product->category_id=$request->category;
        $product->sub_category_id=$request->sub_category;
        $product->brand_id=$request->brand;
        $product->is_featured=$request->is_featured;
        $product->short_description=$request->short_description;
        $product->shipping_returns=$request->shipping_returns;
        $product->related_products=(!empty($request->related_products)) ? implode(",",$request->related_products) : '';
        $product->sku=$request->sku;
        $product->barcode=$request->barcode;
        $product->track_qty=$request->track_qty;
        $product->qty=$request->qty;
        $product->status=$request->status;
        $product->save();

        if(!empty($request->image_array))
        {
            foreach ($request->image_array as $temp_image_id)
            {
                $productImageId=ProductImage::find($temp_image_id);
                if(empty($productImageId))
                {
                    $productImage=new ProductImage();
                    $productImage->product_id=$product->id;
                    $productImage->image='NULL';
                    $productImage->save();

                    $tempImage=TempImage::find($temp_image_id);
                    $extArray=explode('.',$tempImage->name);
                    $ext=last($extArray);
                    $newImage=$product->id.'-'.$productImage->id.'-'.time().'.'.$ext;
                    $productImage->image=$newImage;
                    $productImage->save();

                    $sPath=public_path().'/temp/'.$tempImage->name;
                    $dPath=public_path().'/uploads/product/large/'.$newImage;
                    $image=Image::make($sPath);
                    $image->resize(1400,null,function ($constraint){
                        $constraint->aspectRatio();
                    });
                    $image->save($dPath);

                    $dPath=public_path().'/uploads/product/small/'.$newImage;
                    $image=Image::make($sPath);
                    $image->fit(300,300);
                    $image->save($dPath);
                }

            }
        }
    }

    public function product_image()
    {
        return $this->hasOne(ProductImage::class);
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }
//    public function product_ratings()
//    {
//        return $this->hasMany(ProductRating::class);
//    }
}
