<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index()
    {
        $pages=Page::paginate(10);
        return view('admin.page.index',[
            'pages'=>$pages
        ]);
    }
    public function create()
    {
        return view('admin.page.create');
    }
    public function store(Request $request)
    {
          $validate=Validator::make($request->all(),[
              'name'=>'required',
              'slug'=>'required|unique:pages'
          ]);
          if($validate->fails()){
              return redirect()->route('pages.create')
                  ->withErrors($validate)
                  ->withInput($request->all());
          }else{
              $page=new Page();
              $page->name=$request->name;
              $page->slug=$request->slug;
              $page->content=$request->page_content;
              $page->save();
              return redirect()->route('pages.index')->with('success','Page created successfully');
          }
    }
    public function edit($id)
    {
        $page=Page::find($id);
        if(empty($page))
        {
            return redirect()->route('pages.index')->with('error','Record Not Found');
        }
        return view('admin.page.edit',[
            'page'=>$page
        ]);
    }
    public function update($id,Request $request)
    {
        $page=Page::find($id);
        if(empty($page))
        {
            return redirect()->route('pages.index')->with('error','Record Not Found');
        }
        $validate=Validator::make($request->all(),[
            'name'=>'required',
            'slug'=>'required|unique:pages,slug,'.$id.',id'
        ]);
        if($validate->fails()){
            return redirect()->route('pages.edit',$id)
                ->withErrors($validate)
                ->withInput($request->all());
        }else{
            $page->name=$request->name;
            $page->slug=$request->slug;
            $page->content=$request->page_content;
            $page->save();
            return redirect()->route('pages.index')->with('success','Page Updated successfully');
        }
    }
    public function destroy($id)
    {
        $page=Page::find($id);
        if(empty($page))
        {
            session()->flash('error','Record Not Found');
            return response()->json([
                'status'=>true
            ]);
        }
        $page->delete();
        session()->flash('success','Page deleted successfully');
        return response()->json([
            'status'=>true
        ]);
    }
}
