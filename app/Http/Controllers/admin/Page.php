<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PageModel;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class Page extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Page';
        $page = PageModel::all();
        return view('admin.page.index', compact('title','page'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add Page";
        return view('admin.page.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('dashboard/page/add')
                        ->withErrors($validator)
                        ->withInput();
        };

        PageModel::create([
            'id_page'       =>  Str::uuid(),
            'slug_page'     =>  $request->slug,
            'title'         =>  $request->title,
            'description'   =>  $request->description == null ? '' : $request->description,
            'is_publish'    =>  $request->status,
        ]);

        $notification = array(
            'message' => 'Page Created successfully!',
            'alert-type'    => 'success'
        );

        return redirect('dashboard/page')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $title = "Edit Page";
        $page = PageModel::find($id);
        if ($page == null) {
            return redirect('dashboard/page');
        }
        return view('admin.page.edit', compact('page', 'title'));
    }

   
    public function update(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('dashboard/page/'.$request->id_page)
                        ->withErrors($validator)
                        ->withInput();
        };
        PageModel::where('id_page', $request->id_page)->update([
            'slug_page'     =>  $request->slug,
            'title'         =>  $request->title,
            'description'   =>  $request->description == null ? '' : $request->description,
            'is_publish'    =>  $request->status,
        ]);

        $notification = array(
            'message' => 'Page Update successfully!',
            'alert-type'    => 'success'
        );

        return redirect('dashboard/page')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = PageModel::find($id)->first();
        if (!$page) {
            $notif = array([
                'message' => 'Page not found',
                'alert-type'    => 'danger'
            ]);

            return redirect()->intended('dashboard/page')->with($notif);
        }else{
            PageModel::where('id_Page', $id)->delete();
            $notification = array(
                'message' => 'Page Delete successfully!',
                'alert-type' => 'success'
            );
            
            return Redirect::to('dashboard/page')->with($notification);
        }
    }

    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
         
            $request->file('upload')->move(public_path('assets/image/page/'), $fileName);
    
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('assets/image/page/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
                
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }
}
