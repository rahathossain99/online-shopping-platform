<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class HomeController extends Controller
{
    public function index(){
        $order=Order::where('status','!=','cancelled');
        $totalOrder=$order->count();
        $totalRevenue=$order->sum('grand_total');
        $totalProduct=Product::count();
        $totalCustomer=CustomerAddress::count();
        $currentYear=now()->format('Y');
        $currentMonth=now()->format('m');
        $thisMonthRevenue=$order->whereYear('created_at',$currentYear)->whereMonth('created_at',$currentMonth)->sum('grand_total');
        $thisYearRevenue=$order->whereYear('created_at',$currentYear)->sum('grand_total');
        return view("admin.dashboard",[
            'totalOrder'=>$totalOrder,
            'totalRevenue'=>$totalRevenue,
            'thisYearRevenue'=>$thisYearRevenue,
            'thisMonthRevenue'=>$thisMonthRevenue,
            'totalCustomer'=>$totalCustomer,
            'totalProduct'=>$totalProduct
        ]);
    }
    public function logout(){
        Auth::guard("admin")->logout();
        return redirect()->route('admin.login');
    }
}
