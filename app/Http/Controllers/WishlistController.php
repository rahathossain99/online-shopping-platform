<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
    {
        $wishedProduct=Wishlist::where('product_id',$request->id)->first();
        $product=Product::find($request->id);
        if(!empty($wishedProduct))
        {
            return response()->json([
                'status'=>true,
                'exist'=>true,
                'message'=>$product->title.' is already in wishlist'
            ]);
        }
       if(Auth::check()==false)
       {
           session(['url.redirect'=>url()->previous()]);
           return response()->json([
               'status'=>false,
           ]);
       }
        $wishedItem=new Wishlist();
        $wishedItem->user_id=Auth::user()->id;
        $wishedItem->product_id=$request->id;
        $wishedItem->save();

        return response()->json([
            'status'=>true,
            'exist'=>false,
            'message'=>$product->title.' added in wishlist successfully'
        ]);
    }
    public function deleteToWishlist(Request $request)
    {
        $wishedItem=Wishlist::where('user_id',Auth::user()->id)->find($request->id);
        $wishedItem->delete();
        $request->session()->flash('success','Product deleted from wishlist successfully');
        return response()->json([
            'status'=>true
        ]);
    }
}
