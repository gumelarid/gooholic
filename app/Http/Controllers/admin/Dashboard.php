<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleModel;
use App\Models\CommentModel;
use App\Models\ViewsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $comment = CommentModel::get();
        $article = ArticleModel::get();
        $views = ViewsModel::whereRaw('Date(created_at) = CURDATE()')->get();
        $unique = ViewsModel::select('ip')->groupBy('ip')->get();
        return view('admin/home', compact('title', 'comment', 'article', 'views', 'unique'));
    }
}
