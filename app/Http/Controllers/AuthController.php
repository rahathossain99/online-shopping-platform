<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordEmail;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use function Symfony\Component\Mime\Header\get;

class AuthController extends Controller
{
    public function register()
    {
        return view('front.account.register');
    }

    public function login()
    {
        return view('front.account.login');
    }

    public function processAuth(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'name'=>'required|min:5',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5',
        ]);
        if($validate->passes())
        {
            $user =new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $user->save();
            $request->session()->flash('success','You have been registered successfully');
            return response()->json([
                'status'=>true,
                "message"=>'You have been registered successfully'
            ]);

        }else{
            return response()->json([
                'status'=>false,
                'error'=>$validate->errors()
            ]);
        }
    }
    public function updateUser(Request $request,$id)
    {
        $validate=Validator::make($request->all(),[
            'name'=>'required|min:5',
            'email'=>'required|email|unique:users,email,'.$id.',id',
        ]);
        if($validate->passes())
        {
            $user =User::find($id);
            $user->name=$request->name;
            $user->email=$request->email;
            $user->phone=$request->phone;
            $user->save();
            $request->session()->flash('success','Your Information Updated Successfully');
            return response()->json([
                'status'=>true,
                "message"=>'Your Information Updated Successfully'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'errors'=>$validate->errors()
            ]);
        }
    }
    public function authenticate(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required|min:5'
        ]);
        if($validate->passes())
        {
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password],
                $request->get('remember'))){
                    if(session()->has('url.redirect')) {
                        return redirect(session()->get('url.redirect'));
                    }
                    return redirect()->route('user.profile');
            }else{
                $request->session()->flash('error','Either email/password is incorrect.');
                return redirect()->route('user.login')
                    ->withInput($request->only('email'));
            }
        }else{
            return redirect()->route('user.login')
                ->withErrors($validate)
                ->withInput($request->only('email'));
        }
    }

    public function profile()
    {
        $countries=Country::all();
        $userInfo=User::find(Auth::user()->id);
        $customerAddress=CustomerAddress::where('user_id',Auth::user()->id)->first();
        return view('front.account.profile',[
            'userInfo'=>$userInfo,
            'countries'=>$countries,
            'customerAddress'=>$customerAddress
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login')
            ->with('success','You successfully logged out');
    }

    public function myOrders()
    {
        $user=Auth::user();
        $myOrders=Order::where('user_id',$user->id)->orderBy('created_at','DESC')->get();
        return view('front.account.myorders',[
            'myOrders'=>$myOrders
        ]);
    }
    public function orderDetail($orderId)
    {
        $user=Auth::user();
        $orderInfo=Order::where('id',$orderId)->where('user_id',$user->id)->first();
        $orderCount=OrderItem::where('order_id',$orderId)->count();

        $orderItems=OrderItem::select('order_items.*','products.qty as productQty','products.slug as slug')->where('order_id',$orderId)
                                ->leftJoin('products','products.id','order_items.product_id')
                                ->get();
//        dd($orderItems);
        if(empty($orderInfo))
        {
            return redirect()->back();
        }
        return view('front.account.orders-detail',[
            'orderInfo'=>$orderInfo,
            'orderItems'=>$orderItems,
            'orderCount'=>$orderCount
        ]);
    }
    public function myWishlist()
    {
        $wishedItems=Wishlist::select('wishlists.id as wishId','products.*')->leftJoin('products','products.id','wishlists.product_id')
                                ->where('user_id',Auth::user()->id)->get();
//        dd($wishedItems);
        return view('front.account.wishlist',[
            'wishedItems'=>$wishedItems
        ]);
    }
    public function updateAddress(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            "email" => 'required|email',
            'country' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'mobile' => 'required'
        ]);
        if ($validate->passes()) {
            $user = Auth::user();
            CustomerAddress::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'country' => $request->country,
                    'address' => $request->address,
                    'city' => $request->city,
                    'zip' => $request->zip,
                    'mobile' => $request->mobile,
                    'apartment' => $request->apartment,
                ]
            );
            $request->session()->flash('success','Address updated successfully');
            return redirect()->route('user.profile');
        }
        else{
            return redirect()->route('user.profile')
                ->withErrors($validate)
                ->withInput($request->all());
        }
    }
    public function changePassword()
    {
        return view('front.account.change-password');
    }
    public function changePasswordProcess(Request $request)
    {
        $user=Auth::user();
        $validate=Validator::make($request->all(),[
            'old_password'=>'required',
            'new_password'=>'required|min:5',
            'confirm_password'=>'required|same:new_password',
        ]);
        if($validate->passes())
        {
            if(Hash::check($request->old_password,$user->password))
            {
                $user->password=Hash::make($request->new_password);
                $user->save();
                return redirect()->route('user.profile')->with('success','Your password is changed successfully.');
            }else{
                return redirect()->route('user.changePassword')->with('error','Your old password is incorrect,please try again.');
            }
        }else{
            return redirect()->route('user.changePassword')->withErrors($validate);
        }

    }
    public function forgotPassword()
    {
        return view('front.account.forgot-password');
    }
    public function processForgotPassword(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'email'=>'required|email|exists:users,email'
        ]);
        if($validate->passes())
        {
            $token=Str::random(60);
            DB::table('password_reset_tokens')->where('email',$request->email)->delete();
            DB::table('password_reset_tokens')->insert([
                'email'=>$request->email,
                'token'=>$token,
                'created_at'=>now()
            ]);
            $user=User::where('email',$request->email)->first();
            $mailData=[
                'token'=>$token,
                'user'=>$user,
                'mailSubject'=>'You have requested to reset your password'
            ];
            Mail::to($request->email)->send(new ResetPasswordEmail($mailData));
            return redirect()->route('user.forgotPassword')->with('success','Please check your email to reset your password');

        }else{
            return redirect()->route('user.forgotPassword')->withErrors($validate);
        }
    }
    public function resetPassword($token)
    {
        $tokenExist= DB::table('password_reset_tokens')->where('token',$token)->first();
        if($tokenExist=='')
        {
            return redirect()->route('user.forgotPassword')->with('error','Invalid request');
        }else{
            return view('front.account.reset-password',[
                'token'=>$token
            ]);
        }
    }
    public function processResetPassword(Request $request)
    {
        $tokenExist= DB::table('password_reset_tokens')->where('token',$request->token)->first();
        if($tokenExist=='')
        {
            return redirect()->route('user.forgotPassword')->with('error','Invalid request');
        }
        $validate=Validator::make($request->all(),[
            'new_password'=>'required|min:5',
            'confirm_password'=>'required|same:new_password',
        ]);
        if($validate->fails())
        {
            return redirect()->route('user.resetPassword',$tokenExist->token)->withErrors($validate);
        }
        $user=User::where('email',$tokenExist->email)->first();
        $user->password=Hash::make($request->new_password);
        $user->save();
        DB::table('password_reset_tokens')->where('token',$request->token)->delete();
        return redirect()->route('user.login')->with('success','You have reset your password successfully');
    }
}
