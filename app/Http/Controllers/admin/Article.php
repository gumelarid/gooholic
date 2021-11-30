<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleModel;
use App\Models\CategoryModel;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class Article extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = "List Article";
        $article = DB::table('articles')
                    ->select('users.name', 'articles.*', 'categorys.category')
                    ->leftJoin('categorys', 'categorys.id_category', '=', 'articles.id_category')
                    ->leftJoin('users', 'users.id_user', '=', 'articles.id_user')
                    ->get();
        return view('admin.article.index', compact('title', 'article'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add Article";
        $category = CategoryModel::all();
        return view('admin.article.create', compact('title', 'category'));
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
            'title' => 'required|min:10',
            'slug' => 'required',
            'status' => 'required',
            'subject' => 'required',
            'category' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect('dashboard/article/add')
                        ->withErrors($validator)
                        ->withInput();
        };

        $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('file')->getClientOriginalName());
        $request->file('file')->move(public_path('assets/image/article'), $filename);

        ArticleModel::create([
            'id_article'    =>  Str::uuid(),
            'slug_article'  =>  $request->slug,
            'title' =>  $request->title,
            'subject'       =>  $request->subject,
            'description'   =>  $request->description == null ? '' : $request->description,
            'id_category'   =>  $request->category,
            'id_user'       =>  Auth::user()->id_user,
            'cover'         =>  $filename,
            'is_publish'        =>  $request->status,
            'views'          =>  0
        ]);

        $notification = array(
            'message' => 'Artikel berhasil dibuat!!',
            'alert-type'    => 'success'
        );

        return redirect('dashboard/article')->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $title = "Edit Article";
        $article = ArticleModel::where('id_article', $id)->first();

        if ($article == null) {
            return redirect('dashboard/article');
        }
        $category = CategoryModel::all();
        return view('admin.article.edit', compact('title', 'category', 'article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       
        if (!$request->file('file')) {
            $validator = Validator::make($request->all(), [
                'title' => 'required|min:10',
                'slug' => 'required',
                'status' => 'required',
                'subject' => 'required',
                'category' => 'required',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'title' => 'required|min:10',
                'slug' => 'required',
                'status' => 'required',
                'category' => 'required',
                'file' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);
        }
        

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        };

        $check = ArticleModel::where('id_article', $request->id)->first();
        if ($check) {

            if ($request->file('file')) {
                if ($check->cover) {
                    unlink('assets/image/article/'.$check->cover);
                };

                $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('file')->getClientOriginalName());
                $request->file('file')->move(public_path('assets/image/article'), $filename);

                ArticleModel::where('id_article', $request->id)->update([
                    'slug_article'  =>  $request->slug,
                    'title'         =>  $request->title,
                    'subject'       =>  $request->subject,
                    'description'   =>  $request->description == null ? '' : $request->description,
                    'id_category'   =>  $request->category,
                    'id_user'       =>  Auth::user()->id_user,
                    'cover'         =>  $filename,
                    'is_publish'    =>  $request->status,
                    'view'         =>  0
                ]);
            }else{
                ArticleModel::where('id_article', $request->id)->update([
                    'slug_article'  =>  $request->slug,
                    'title'         =>  $request->title,
                    'subject'       =>  $request->subject,
                    'description'   =>  $request->description == null ? '' : $request->description,
                    'id_category'   =>  $request->category,
                    'id_user'       =>  Auth::user()->id_user,
                    'is_publish'    =>  $request->status,
                    'view'         =>  0
                ]);
            }

            $notification = array(
                'message' => 'Artikel berhasil di updated!!',
                'alert-type'    => 'success'
            );
    
            return redirect('dashboard/article')->with($notification);
            
        }else{
            $notification = array(
                'message' => 'Update Gagal!!',
                'alert-type'    => 'danger'
            );
    
            return redirect('dashboard/article')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = ArticleModel::where('id_article', $id)->first();
        if (!$article) {
            $notif = array([
                'message' => 'Artikel tidak ditemukan',
                'alert-type'    => 'danger'
            ]);

            return redirect()->intended('dashboard/article')->with($notif);
        }else{

            if ($article->cover) {
                unlink('assets/image/article/'.$article->cover);
            };

            $Article = ArticleModel::where('id_article', $id)->delete();
            $notification = array(
                'message' => 'Artikel berhasil dihapus!',
                'alert-type' => 'success'
            );
            
            return Redirect::to('/dashboard/article')->with($notification);
        }
    }

    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
         
            $request->file('upload')->move(public_path('assets/image/article/'), $fileName);
    
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('assets/image/article/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
                
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }

    public function addCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|unique:categorys',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }else{
            CategoryModel::create([
                'id_category'       => Str::uuid(),
                'slug_category'          => Str::slug($request->category),
                'category'         => $request->category,
            ]);

            $notification = array(
                'message' => 'category berhasil dibuat!',
                'alert-type' => 'success'
            );
            
            return redirect()->back()->with($notification)->withInput();

        }
    }
}
