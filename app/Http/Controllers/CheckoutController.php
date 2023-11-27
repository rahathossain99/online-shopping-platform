<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\DiscountCoupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Shipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Http\Discovery\Exception\NotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Stripe\Stripe;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $shippingCharge=0.0;
        $discount=0.0;
        $totalQty=0;
        $grandToltal=0.0;
        $totalShippingCharge=0.0;
        $subTotal=Cart::subtotal('2','.','');
        if($request->session()->has('code'))
        {
            $code=session()->get('code');
            if(!empty($code->min_amount) && $subTotal>=$code->min_amount)
            {
                if($code->type=='percent')
                {
                    $discount=($code->discount_amount/100)*$subTotal;
                }else{
                    $discount=$code->discount_amount;
                }
            }
        }
        if(Cart::count()==0)
        {
            return redirect()->route('front.cart');
        }

        if(Auth::check()==false)
        {
            session(['url.redirect'=>url()->current()]);
            return redirect()->route('user.login');
        }
        session()->forget('url.redirect');
        $user=Auth::user();
        $countries=Country::orderBy('name','ASC')->get();
        $customerAddress=CustomerAddress::where('user_id',$user->id)->first();
        if(!empty($customerAddress))
        {
            $shipping=Shipping::where('country_id',$customerAddress->country_id)->first();
            $shippingCharge=$shipping->amount;
            foreach (Cart::content() as $item)
            {
                $totalQty+=$item->qty;
//                dd($item->id);
            }
            $totalShippingCharge=$totalQty*$shippingCharge;
        }

        $grandToltal=$totalShippingCharge+$subTotal-$discount;

        return view('front.checkout',[
            'customerAddress'=>$customerAddress,
            'countries'=>$countries,
            'totalShippingCharge'=>$totalShippingCharge,
            'grandToltal'=>$grandToltal,
            'discount'=>number_format($discount,2)
        ]);
    }

    public function checkoutStore(Request $request)
    {

        $validate=Validator::make($request->all(),[
            'first_name'=>'required',
            'last_name'=>'required',
            "email"=>'required|email',
            'country'=>'required',
            'address'=>'required',
            'city'=>'required',
            'zip'=>'required',
            'mobile'=>'required'
        ]);
        if($validate->passes())
        {
            $user=Auth::user();

            //store data in customer table
            CustomerAddress::updateOrCreate(
                ['user_id'=>$user->id],
                [
                    'user_id'=>$user->id,
                    'first_name'=>$request->first_name,
                    'last_name'=>$request->last_name,
                    'email'=>$request->email,
                    'country_id'=>$request->country,
                    'address'=>$request->address,
                    'city'=>$request->city,
                    'zip'=>$request->zip,
                    'mobile'=>$request->mobile,
                    'apartment'=>$request->apartment,
                ]
            );

            //store data in order table

            $totalQty=0;
            $grandToltal=0.0;
            $totalShippingCharge=0.0;
            $shippingCharge=0.0;
            $discount=0;
            $coupon_code=null;
            $subtotal=Cart::subtotal(2,'.','');
            $shipping=Shipping::where('country_id',$request->country)->first();
            foreach (Cart::content() as $item)
            {
                $totalQty+=$item->qty;
            }
            if(!empty($shipping))
            {
                $shippingCharge=$shipping->amount;
            }else{
                $shipping=Shipping::where('country_id','rest_of_world')->first();
                $shippingCharge=$shipping->amount;
            }
            if($request->session()->has('code'))
            {
                $code=session()->get('code');
                $coupon_code=$code->code;
                if(!empty($code->min_amount) && $subtotal>=$code->min_amount)
                {
                    if($code->type=='percent')
                    {
                        $discount=($code->discount_amount/100)*$subtotal;
                    }else{
                        $discount=$code->discount_amount;
                    }
                }
            }
            if(Session::has('code'))
            {
                Session::forget('code');
            }
            $totalShippingCharge=$totalQty*$shippingCharge;
            $grandToltal=$totalShippingCharge+$subtotal-$discount;

            if($request->payment_method=='stripe')
            {
                \Stripe\Stripe::setApiKey('sk_test_51ODpC2Eu0oBNLBW28DNUhXGkbtqB3oXqxtbllrn6tRq28hPP6yptNEAfwnpBLEarbTRg44Cy0c7PsHTrqblvDiSz00fETiuxaO');
                $lineItems=[];
                foreach (Cart::content() as $product){
                    $lineItems[]=[
                        'price_data' => [
                            'currency'     => 'USD',
                            'product_data' => [
                                "name" =>$product->name ,
                            ],
                            'unit_amount'  =>$product->price,
                        ],
                        'quantity'   => $product->qty
                    ];
                }
                $session = \Stripe\Checkout\Session::create([
                    'line_items'  => $lineItems,
                    'mode'        => 'payment',
                    'success_url' => route('front.thanks',[],true)."?session_id={CHECKOUT_SESSION_ID}",
                    'cancel_url'  => route('front.paymentCancel',[],true),
                ]);
            }


            $order=new Order();
            $order->subtotal=$subtotal;
            $order->shipping=$totalShippingCharge;
            $order->grand_total=$grandToltal;
            $order->discount=$discount;
            $order->coupon_code=$coupon_code;
            if($request->payment_method=='cod') {
                $order->payment_status = 'cod';
            }else{
                $order->payment_status = 'unpaid';
                $order->session_id=$session->id;
            }
            $order->status='pending';
            $order->user_id=$user->id;
            $order->first_name=$request->first_name;
            $order->last_name=$request->last_name;
            $order->email=$request->email;
            $order->country_id=$request->country;
            $order->address=$request->address;
            $order->city=$request->city;
            $order->zip=$request->zip;
            $order->mobile=$request->mobile;
            $order->apartment=$request->apartment;
            $order->notes=$request->order_notes;
            $order->save();
            foreach (Cart::content() as $item)
            {
                $orderItem=new OrderItem();
                $orderItem->order_id=$order->id;
                $orderItem->product_id=$item->id;
                $orderItem->name=$item->name;
                $orderItem->price=$item->price;
                $orderItem->qty=$item->qty;
                $orderItem->total=$item->price*$item->qty;
                $orderItem->save();

                $productData=Product::find($item->id);
                if($productData->track_qty=='Yes')
                {
                    $productData->qty-=$item->qty;
                    $productData->save();
                }
            }
            if($request->payment_method=='stripe') {
                return redirect()->away($session->url);
            }else{
                return redirect()->route('front.thanks',$order->id);
            }
        }else{
            return response()->json([
                'status'=>false,
                'error'=>$validate->errors()
            ]);
        }
    }

    public function thanks(Request $request,$id=null)
    {
        $customer=null;
        $order=null;
        $order=Order::find($id);

        try{
            if(empty($id))
            {
                \Stripe\Stripe::setApiKey('sk_test_51ODpC2Eu0oBNLBW28DNUhXGkbtqB3oXqxtbllrn6tRq28hPP6yptNEAfwnpBLEarbTRg44Cy0c7PsHTrqblvDiSz00fETiuxaO');
                $sessionId=$request->get('session_id');
                $session = \Stripe\Checkout\Session::retrieve($sessionId);
                if(empty($session)){
                    throw new NotFoundHttpException();
                }
                $order=Order::where('session_id',$session->id)->first();
                if(empty($order))
                {
                    throw new NotFoundHttpException();
                }
                if($order->payment_status=='unpaid')
                {
                    $order->payment_status='paid';
                    $order->save();
                }
            }else{
                $order=Order::find($id);
                if(empty($order))
                {
                    throw new NotFoundHttpException();
                }
            }
            $customer=$order->first_name.' '.$order->last_name;
            orderEmail($order->id);
            Cart::destroy();
            return view('front.thanks',[
                'id'=>$order->id,
                'customer'=>$customer
            ]);
        }catch (\Exception $e){
            $e->getMessage();
        }
    }

    public function getAmount(Request $request)
    {
        $totalQty=0;
        $grandToltal=0.0;
        $totalShippingCharge=0.0;
        $shippingCharge=0.0;
        $discount=0.0;
        $discountString='';
        $subTotal=Cart::subtotal('2','.','');
        $shipping=Shipping::where('country_id',$request->country_id)->first();
        foreach (Cart::content() as $item)
        {
            $totalQty+=$item->qty;
        }
        if(!empty($shipping))
        {
            $shippingCharge=$shipping->amount;
        }else{
            $shipping=Shipping::where('country_id','rest_of_world')->first();
            $shippingCharge=$shipping->amount;
        }
        if($request->session()->has('code'))
        {
            $code=session()->get('code');
            if(!empty($code->min_amount) && $subTotal>=$code->min_amount)
            {
                if($code->type=='percent')
                {
                    $discount=($code->discount_amount/100)*$subTotal;
                }else{
                    $discount=$code->discount_amount;
                }
                $discountString='<div id="coupon">
                                <div class=" mt-4">
                                    <strong id="coupon_session">'.session()->get('code')->code.'</strong>
                                    <button type="button" class="btn btn-danger btn-sm ms-1" id="coupon_code_delete">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>';
            }
        }

        $totalShippingCharge=$totalQty*$shippingCharge;
        $grandToltal=$totalShippingCharge+$subTotal-$discount;

        return response()->json([
            'status'=>true,
            'totalShippingCharge'=>number_format($totalShippingCharge,2),
            'grandToltal'=>number_format($grandToltal,2),
            'discount'=>number_format($discount,2),
            'discountString'=>$discountString
        ]);
    }

    public function applyCoupon(Request $request)
    {
        $discountCoupon=DiscountCoupon::where('code',$request->code)->first();
        if(empty($discountCoupon))
        {
            return response()->json([
                'status'=>false,
                'message'=>'Invalid Coupon Code'
            ]);
        }
        if(!empty($discountCoupon->starts_at))
        {
            $now=now();
            $currentDate=$now->format('Y-m-d H:i:s');
            if($currentDate<$discountCoupon->starts_at)
            {
                return response()->json([
                    'status'=>false,
                    'message'=>'Coupon hans\'t started'
                ]);
            }
        }
        if(!empty($discountCoupon->expires_at))
        {
            $now=now();
            $currentDate=$now->format('Y-m-d H:i:s');
            if($currentDate>$discountCoupon->expires_at)
            {
                return response()->json([
                    'status'=>false,
                    'message'=>'Coupon  Expired'
                ]);
            }
        }
        if(!empty($discountCoupon->max_uses))
        {
            $maxUse=Order::where('coupon_code',$discountCoupon->code)->count();
            if($maxUse>=$discountCoupon->max_uses)
            {
                return response()->json([
                    'status'=>false,
                    'message'=>'Max Uses Reached'
                ]);
            }
        }
        if(!empty($discountCoupon->max_uses_user))
        {
            $user=Auth::user()->id;
            $maxUser=Order::where('user_id',$user)->where('coupon_code',$discountCoupon->code)->count();
            if($maxUser>=$discountCoupon->max_uses_user)
            {
                return response()->json([
                    'status'=>false,
                    'message'=>'You Have Used Up Your Coupon'
                ]);
            }
        }

        session()->put('code',$discountCoupon);
        return $this->getAmount($request);
    }

    public function deleteCoupon(Request $request)
    {
        if(Session::has('code'))
        {
            Session::forget('code');
        }
//        return response()->json(['data'=>Session::get('code')]);
        return $this->getAmount($request);
    }

    public function paymentCancel()
    {
        return "Something went wrong";
    }
    public function webhook()
    {
        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = 'whsec_fce2ee8a12ece18915786cbf45ed54841d81a6993697ab5b4ca2d70d979f6f69';

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response('',400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('',400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                $order=Order::where('session_id',$session->id)->first();
                if(!empty($order) && $order->payment_status=='unpaid')
                {
                    $order->payment_status='paid';
                    $order->save();
                    orderEmail($order->id);
                    Cart::destroy();
                }
            // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('');
    }
}
