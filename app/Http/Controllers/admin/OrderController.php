<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user=Auth::user();
        $orders=Order::select('orders.*','users.name','users.email')->leftJoin('users','users.id','orders.user_id')->latest('orders.created_at');
        if(!empty($request->get('keyword')))
        {
            $orders=$orders->where('users.id','like','%'.$request->get('keyword').'%');
            $orders=$orders->orWhere('users.name','like','%'.$request->get('keyword').'%');
            $orders=$orders->orWhere('users.email','like','%'.$request->get('keyword').'%');

        }
        $orders=$orders->paginate(10);
        return view('admin.orders.index',[
            'orders'=>$orders
        ]);
    }
    public function detail($orderId)
    {
        $orderInfo=Order::select('orders.*')->leftJoin('users','users.id','orders.user_id')
                        ->with('orderedProduct')
                        ->where('orders.id',$orderId)
                        ->first();
        if(empty($orderInfo))
        {
            return redirect()->back();
        }
        return view('admin.orders.details',[
            'orderInfo'=>$orderInfo
        ]);
    }
    public function changeOrderStatus(Request $request,$orderId)
    {
        $order=Order::find($orderId);
        $order->status=$request->status;
        $order->shipped_date=$request->shipped_date;
        $order->save();
        $request->session()->flash('success','Order Status Updated Successfully');
        return response()->json([
            'status'=>true,
            'message'=>'Order Status Updated Successfully'
        ]);
    }
}
