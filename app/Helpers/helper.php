<?php
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderEmail;
use App\Models\EnterpriseInfo;

function getCategories()
{
    return Category::orderBy('name','ASC')
        ->where('status',1)
        ->with('sub_categories')
        ->where('show_home','Yes')
        ->get();
}

function getProductImage($productId)
{
    return ProductImage::where('product_id',$productId)->first();
}

function orderEmail($orderId)
{
    $order=Order::where('id',$orderId)->with('orderedProduct')->first();
    $mailData=[
        'subject'=>'Thanks for your order',
        'order'=>$order
    ];

    Mail::to($order->email)->send(new OrderEmail($mailData));
}

function enterpriseInfo()
{
    return EnterpriseInfo::leftJoin('countries','countries.id','enterprise_infos.country')->find(1);
}
