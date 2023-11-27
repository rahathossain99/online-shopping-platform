<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductRating;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{

    public function index(Request $request,$categorySlug=null,$subCategorySlug=null)
    {
        $subCategorySelectedId='';
        $categorySelectedId='';
        $brandSelectedId='';
        $priceSelected='';
        $products=Product::where('status',1)->with('product_image');
        if(!empty($categorySlug))
        {
            $category=Category::where('slug',$categorySlug)->first();
            if(!empty($category))
            {
                $products=$products->where('category_id',$category->id);
                $categorySelectedId=$category->id;
            }else{
                return redirect()->back();
            }
        }

        if(!empty($subCategorySlug))
        {
            $subCategory=SubCategory::where('slug',$subCategorySlug)->first();
            if(!empty($subCategory))
            {
                $products=$products->where('sub_category_id',$subCategory->id);
                $subCategorySelectedId=$subCategory->id;
            }else{
                return redirect()->back();
            }

        }

        if(!empty($request->get('brand')))
        {
            $products=$products->where('brand_id',$request->get('brand'));
            $brandSelectedId=$request->get('brand');
        }
        if(!empty($request->get('search')))
        {
            $products=$products->where('slug','like','%'.$request->get('search').'%');
        }
        if(!empty($request->get('price_max')) && !empty($request->get('price_min')))
        {
            $products=$products->whereBetween('price',[$request->get('price_min'),$request->get('price_max')]);
            $brandSelectedId=$request->get('brand');
            $priceSelected=$request->get('price_min');
        }

        if(!empty($request->get('sort-by')))
        {
            if($request->get('sort-by')=='price_high')
            {
                $products=$products->orderBy('price','DESC');
            }
            elseif ($request->get('sort-by')=='price_low')
            {
                $products=$products->orderBy('price','ASC');
            }
        }else{
            $products=$products->orderBy('id','DESC');
        }

        $categories=Category::orderBy('name','ASC')->where('status',1)->with('sub_categories')->get();
        $brands=Brand::orderBy('name','ASC')->where('status',1)->get();
        $products=$products->paginate(12);

        return view('front.shop',[
            'categories'=>$categories,
            'brands'=>$brands,
            'products'=>$products,
            'subCategorySelectedId'=>$subCategorySelectedId,
            'categorySelectedId'=>$categorySelectedId,
            'brandSelectedId'=>$brandSelectedId,
            'priceSelected'=>$priceSelected,
            'priceMin'=>intval($request->get('price_min')),
            'priceMax'=>(intval($request->get('price_max')))==0 ? 150000 : intval($request->get('price_max')),
            'sortSelected'=>$request->get('sort-by')

        ]);
    }

    public function product($productSlug)
    {
        $product=Product::where('slug',$productSlug)->with('product_images')->first();
        $productRatings=ProductRating::latest('id')->where('product_id',$product->id)->where('status',1)->get();
        $numberOfProductRating=$productRatings->count();
        $overallProductRating=$productRatings->avg('rating');
        if(empty($product))
        {
            return redirect()->back();
        }
        $relatedProducts=[];
        if(!empty($product->related_products))
        {
            $relatedArr=explode(',',$product->related_products);
            $relatedProducts=Product::whereIn('id',$relatedArr)->with('product_image')->get();
        }
        return view('front.product',[
            'product'=>$product,
            'relatedProducts'=>$relatedProducts,
            'overallProductRating'=>$overallProductRating,
            'productRatings'=>$productRatings,
            'numberOfProductRating'=>$numberOfProductRating,
            ]);
    }

    public function storeRating($id,Request $request)
    {
        $product=Product::find($id);
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'rating'=>'required',
            'review'=>'required'
        ]);
        if($validator->fails())
        {
            return redirect()->route('front.product',$product->slug)
                ->withErrors($validator)
                ->withInput($request->all());
        }
        $rating=new ProductRating();
        $rating->product_id=$id;
        $rating->username=$request->name;
        $rating->email=$request->email;
        $rating->rating=$request->rating;
        $rating->comment=$request->review;
        $rating->save();
        return redirect()->route('front.product',$product->slug)->with('success','Thanks for your rating');
    }
}
