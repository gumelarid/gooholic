<?php

// front
use App\Http\Controllers\Home;
use App\Http\Controllers\Post;
use App\Http\Controllers\Category as CategoryHome;
use App\Http\Controllers\Comment as CommentHome;

// admin
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\Dashboard;
use App\Http\Controllers\admin\Article;
use App\Http\Controllers\admin\User;
use App\Http\Controllers\admin\Category;
use App\Http\Controllers\admin\Page;
use App\Http\Controllers\admin\Comment;
use App\Http\Controllers\admin\Setting;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Home::class, 'index']);
Route::get('/search', [Home::class, 'search']);
Route::get('/blog/{slug}', [Post::class, 'index']);
Route::get('/page/{slug}', [Home::class, 'page']);
Route::get('/category/{slug}', [CategoryHome::class, 'index']);
Route::post('/comment',[CommentHome::class, 'index']);


Route::get('administrator', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('auth', [AuthController::class, 'login']);
Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard',[Dashboard::class, 'index']);

    // Category
    Route::get('/dashboard/category', [Category::class, 'index']);
    Route::post('/dashboard/category/store', [Category::class, 'store']);
    Route::get('/dashboard/category/show', [Category::class, 'show']);
    Route::post('/dashboard/category/update', [Category::class, 'update']);
    Route::get('/dashboard/category/delete/{id}', [Category::class, 'destroy']);

    // Setting
    Route::get('/dashboard/setting', [Setting::class, 'index']);
    Route::post('/dashboard/setting/save', [Setting::class, 'update']);
    Route::get('/dashboard/setting/delete/{id}', [Setting::class, 'destroy']);

    // User
    Route::get('/dashboard/user', [User::class, 'index']);
    Route::get('/dashboard/user/add', [User::class, 'create']);
    Route::post('/dashboard/user/store', [User::class, 'store']);
    Route::post('/dashboard/user/update', [User::class, 'update']);
    Route::get('/dashboard/user/{id}', [User::class, 'edit']);
    Route::get('/dashboard/user/delete/{id}', [User::class, 'destroy']);

    Route::get('/dashboard/profile/{id}', [User::class, 'profile']);
    Route::post('/dashboard/profile/update', [User::class, 'updateProfile']);

    // Article 
    Route::get('/dashboard/article', [Article::class, 'index']);
    Route::get('/dashboard/article/add', [Article::class, 'create']);
    Route::get('/dashboard/article/{id}', [Article::class, 'edit']);
    Route::get('/dashboard/article/delete/{id}', [Article::class, 'destroy']);
    
    Route::post('/dashboard/article/store', [Article::class, 'store']);
    Route::post('/dashboard/article/update', [Article::class, 'update']);

    Route::post('/dashboard/article/upload', [Page::class, 'upload'])->name('upload.upload');
    Route::post('dashboard/article/category',[Article::class, 'addCategory']);

    // Pages
    Route::get('/dashboard/page', [Page::class, 'index']);
    Route::get('/dashboard/page/add', [Page::class, 'create']);
    Route::post('/dashboard/page/store', [Page::class, 'store']);
    Route::get('/dashboard/page/{id}', [Page::class, 'edit']);
    Route::post('/dashboard/page/update', [Page::class, 'update']);
    Route::get('/dashboard/page/delete/{id}', [Page::class, 'destroy']);

    Route::post('/dashboard/page/upload', [Page::class, 'upload'])->name('upload.upload');


    // comment
    Route::get('/dashboard/comment', [Comment::class, 'index']);
    Route::get('/dashboard/comment/show', [Comment::class, 'show']);
    Route::get('/dashboard/comment/showRead', [Comment::class, 'showRead']);
    Route::post('/dashboard/comment/reply', [Comment::class, 'reply']);
    Route::get('/dashboard/comment/delete/{id}', [Comment::class, 'destroy']);

    Route::get('logout', [AuthController::class, 'logout']);
});