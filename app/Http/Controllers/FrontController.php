<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use App\Models\Page;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    public function index()
    {
        $featuredProducts=Product::where('is_featured','Yes')->where('status',1)->with('product_image')->get();
        $latestProducts=Product::orderBy('id','ASC')->where('status',1)->with('product_image')->take(12)->get();
        return view('front.home',[
            'featuredProducts'=>$featuredProducts,
            'latestProducts'=>$latestProducts
        ]);
    }
    public function page($slug)
    {
        $page=Page::where('slug',$slug)->first();
        return view('front.page',[
            'page'=>$page
        ]);
    }
    public function mailContact(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'subject'=>'required'
        ]);

        if($validator->passes()){
            $mailData=[
                'name'=>$request->name,
                'email'=>$request->email,
                'subject'=>$request->subject,
                'message'=>$request->message,
                'contact_subject'=>'You have received a contact email'
            ];
            $admin=User::find(1);
            Mail::to($admin->email)->send(new ContactEmail($mailData));
            return redirect()->route('front.page','contact-us')
                ->with('success','Thanks for contacting us,we will get back to you soon');

        }else{
            return redirect()->route('front.page','contact-us')
                ->withErrors($validator)
                ->withInput($request->all());
        }

    }
}
