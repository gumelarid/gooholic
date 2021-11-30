<?php

namespace App\Http\Controllers;

use App\Models\ArticleModel;
use App\Models\CommentModel;
use App\Models\ViewsModel;
use Illuminate\Http\Request;

class Post extends Controller
{
    public function index(Request $request, $slug)
    {
        $article = ArticleModel::select('users.name', 'articles.*', 'categorys.category', 'categorys.slug_category')
            ->leftJoin('categorys', 'categorys.id_category', '=', 'articles.id_category')
            ->leftJoin('users', 'users.id_user', '=', 'articles.id_user')
            ->where('slug_article', $slug)
            ->first();


        $comments = CommentModel::where('is_publish', '1')->where('id_article', $article->id_article)->orderBy('created_at','desc')->get();

        ViewsModel::create([
            'ip'            => $request->ip(),
            'id_article'    => $article->id_article,
        ]);

        ArticleModel::where('id_article', $article->id_article)->update([
            'view'         =>  ($article->view + 1)
        ]);

        $title = $article->title;
        return view('front.read',compact('article', 'title', 'comments'));
    }
}
