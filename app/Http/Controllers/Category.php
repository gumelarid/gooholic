<?php

namespace App\Http\Controllers;

use App\Models\ArticleModel;
use App\Models\CategoryModel;
use Illuminate\Http\Request;

class Category extends Controller
{
    public function index($slug)
    {
        $category = CategoryModel::where('slug_category', $slug)->first();
        $article = ArticleModel::select('users.name', 'articles.*', 'categorys.category', 'categorys.slug_category')
            ->leftJoin('categorys', 'categorys.id_category', '=', 'articles.id_category')
            ->leftJoin('users', 'users.id_user', '=', 'articles.id_user')
            ->where('is_publish', '1')
            ->where('slug_category', $slug)
            ->get();

        $title = 'Category: '.$category->category;
        return view('front.category',compact('article', 'title'));
    }
}
