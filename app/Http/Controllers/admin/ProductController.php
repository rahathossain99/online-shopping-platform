<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products=Product::latest('id')->with('product_image');
        if(!empty($request->get('keyword')))
        {
            $products=$products->where('title','like','%'.$request->get('keyword').'%');
        }
        $products=$products->paginate(10);

        return view('admin.product.index',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::orderBy('name','ASC')->get();
        $brands=Brand::orderBy('name','ASC')->get();

        return view('admin.product.create',[
            'categories'=>$categories,
            'brands'=>$brands
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules=[
            'title'=>'required',
            'slug'=>'required | unique:products',
            'price'=>'required | numeric',
            'sku'=>'required',
            'track_qty'=>'required | in:Yes,No',
            'category'=>'required | numeric',
            'is_featured'=>'required | in:Yes,No'
        ];

        if(!empty($request->track_qty) && $request->track_qty=='Yes')
        {
            $rules['qty']='required | numeric';
        }

        $validator=Validator::make($request->all(),$rules);
        if($validator->passes())
        {
            Product::addProduct($request);
            $request->session()->flash('success','Product added successfully');
            return response()->json([
                'status'=>true,
                'message'=>'Product added successfully'
            ]);
        }
        else
            {
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id,Request $request)
    {
        $product=Product::find($id);
        if(empty($product))
        {
            $request->session()->flash('error','Product not found');
            return redirect()->route('products.index')->with('error','Product not found');
        }

        $productImages=ProductImage::where('product_id',$product->id)->get();
        $categories=Category::orderBy('name','ASC')->get();
        $brands=Brand::orderBy('name','ASC')->get();
        $subcategories=SubCategory::where('category_id',$product->category_id)->get();

        return view('admin.product.edit',[
            'product'=>$product,
            'categories'=>$categories,
            'brands'=>$brands,
            'subCategories'=>$subcategories,
            'productImages'=>$productImages
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
//        return $request->image_array;
        $product=Product::find($id);
        if(empty($product))
        {
            $request->session()->flash('error','Records not found');
            return response()->json([
                'status'=>true,
                'message'=>'Records not found'
            ]);
        }
        $rules=[
            'title'=>'required',
            'slug'=>'required | unique:products,slug,'.$id.'id',
            'price'=>'required | numeric',
            'sku'=>'required',
            'track_qty'=>'required | in:Yes,No',
            'category'=>'required | numeric',
            'is_featured'=>'required | in:Yes,No'
        ];

        if(!empty($request->track_qty) && $request->track_qty=='Yes')
        {
            $rules['qty']='required | numeric';
        }

        $validator=Validator::make($request->all(),$rules);
        if($validator->passes())
        {
            Product::updateProduct($request,$id);
            $request->session()->flash('success','Product updated successfully');
            return response()->json([
                'status'=>true,
                'message'=>'Product updated successfully'
            ]);
        }
        else
        {
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

        $product=Product::find($id);
        if(empty($product)){
            Session::flash('error','Record not found');
            return response()->json([
                'message'=>'Record not found'
            ]);
        }
        $productImages=ProductImage::where('product_id',$id)->get();
        if(!empty($productImages))
        {
            foreach ($productImages as $productImage)
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
            }
        }

        $product->delete();
        Session::flash("success","Product deleted successfully");
        return response()->json([
            'status'=>true,
            'message'=>"Product deleted successfully"
        ]);
    }
    public function getProducts(Request $request)
    {
        if(!empty($request->term))
        {
            $temProducts=[];
            $products=Product::where('title','like','%'.$request->term.'%')->get();
            if(!empty($products))
            {

                foreach ($products as $product)
                {
                    $temProducts[]=array('id'=>$product->id,'text'=>$product->title);
                }
            }
            return response()->json([
                'status'=>true,
                'tags'=>$temProducts
            ]);
        }
//        return response()->json([
//            'status'=>false,
//            'message'=>"Product fund successfully"
//        ]);
    }
}
