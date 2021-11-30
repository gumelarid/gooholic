<?php

namespace App\Http\Controllers;

use App\Models\PageModel;
use App\Models\SettingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Home extends Controller
{
    public function index()
    {
        $web = SettingModel::all()->first();
        $title = $web->name_web;

        $newPost = DB::table('articles')
        ->select('users.name', 'articles.*', 'categorys.category','categorys.slug_category')
        ->leftJoin('categorys', 'categorys.id_category', '=', 'articles.id_category')
        ->leftJoin('users', 'users.id_user', '=', 'articles.id_user')
        ->where('is_publish','1')
        ->orderBy('created_at', 'desc')
        ->paginate(4);

        return view('front.home', compact('newPost', 'title'));
    }

    public function search(Request $request)
    {
        $title = 'Search: '.$request->keyword; 
        $article = DB::table('articles')
        ->select('users.name', 'articles.*', 'categorys.category','categorys.slug_category')
        ->leftJoin('categorys', 'categorys.id_category', '=', 'articles.id_category')
        ->leftJoin('users', 'users.id_user', '=', 'articles.id_user')
        ->where('is_publish','1')
        ->where('title', 'like', '%'.$request->keyword.'%')
        ->get();

        return view('front.search', compact('article', 'title'));
    }

    public function page($slug)
    {
        $page = PageModel::where('slug_page', $slug)->first();
        $title = $page->title;
        return view('front.page',compact('page', 'title'));
    }
}
