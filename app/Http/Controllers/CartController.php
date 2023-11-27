<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        $cartContents=Cart::content();
        return view('front.cart',['cartContents'=>$cartContents]);
    }

    public function addToCart(Request $request)
    {
        $status=false;
        $message='';
        $product=Product::with('product_images')->find($request->id);
        if(empty($product))
        {
            return response()->json([
                'status'=>false,
                'message'=>'product not found'
            ]);
        }
        if(Cart::count()>0)
        {
            $cartProductExist=false;
            $cartContents=Cart::content();
            foreach ($cartContents as $cartContent)
            {
                if($cartContent->id==$product->id)
                {
                    $cartProductExist=true;
                }
            }

            if($cartProductExist==false)
            {
                Cart::add($product->id,$product->title,1,$product->price,['productImage'=>
                    (!empty($product->product_images)) ? $product->product_images->first() : ""]);
                $status=true;
                $request->session()->flash('success',$product->title.'  added in cart');
                $message=$product->title.'  added in cart';

            }
            else{
                $status=false;
                $message=$product->title.' already added in cart';
            }
        }else{
            Cart::add($product->id,$product->title,1,$product->price,['productImage'=>
                (!empty($product->product_images)) ? $product->product_images->first() : ""]);
            $status=true;
            $request->session()->flash('success',$product->title.'  added in cart');
            $message=$product->title.'  added in cart';
        }
        return response()->json([
            'status'=>$status,
            'message'=>$message,
        ]);

    }

    public function updateToCart(Request $request)
    {
        $id=$request->rowId;
        $qty=$request->qty;
        $productInfo=cart::get($id);
        $status=false;
        $message='';
        $product=Product::find($productInfo->id);
        if(!empty($product))
        {
            if($product->track_qty=="Yes")
            {
                $productQty=$product->qty;
                if($request->cal=="add")
                {
                    if($productQty>=$qty)
                    {
                        Cart::update($id,$qty);
                        $request->session()->flash('success','Cart Updated Successfully');
                        $status=true;
                        $message="Cart Updated Successfully";
                    }else{
                        $request->session()->flash('error',$product->title.' is out of stock');
                        $status=true;
                        $message="Product not available";
                    }

                }else{
                    Cart::update($id,$qty);
                    $request->session()->flash('success','Cart Updated Successfully');
                    $status=true;
                    $message="Cart Updated Successfully";
                }
            }else{
                Cart::update($id,$qty);
                $request->session()->flash('success','Cart Updated Successfully');
                $status=true;
                $message="Cart Updated Successfully";
            }

        }
        return response()->json([
            'status'=>$status,
            'message'=>$message
        ]);
    }

    public function deleteCart(Request $request)
    {
        $cartItem=Cart::get($request->rowId);
        if(empty($cartItem))
        {
            $request->session()->flash('error',"Item not found");
            return response()->json([
                'status'=>true,
                'message'=>"Item not found"
            ]);
        }
        Cart::remove($request->rowId);
        $request->session()->flash('success',"Cart deleted Successfully");
        return response()->json([
            'status'=>true,
            'message'=>"Cart deleted Successfully"
        ]);
    }
}



