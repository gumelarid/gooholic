<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CommentModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class Comment extends Controller
{
    public function index(Request $request)
    {
        $title = 'comments';
        $unPublish = CommentModel::select('articles.title', 'comments.*')
                        ->Join('articles', 'articles.id_article', '=', 'comments.id_article')
                        ->where('comments.is_publish', '0')
                        ->orderBy('created_at','desc')
                        ->get();
        
        $publish = CommentModel::select('articles.title', 'comments.*')
                        ->Join('articles', 'articles.id_article', '=', 'comments.id_article')
                        ->where('comments.is_publish', '1')
                        ->where('comments.id_parent', '')
                        ->orderBy('created_at','desc')
                        ->get();
        
        return view('admin.comment.index', compact('title', 'unPublish', 'publish'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $title = 'comments';
        $comment = CommentModel::select('articles.id_article','articles.title', 'comments.*')
                                ->Join('articles', 'articles.id_article', '=', 'comments.id_article')
                                ->where('id_comments', $request->id_comment)
                                ->first();
        CommentModel::where('id_comments', $request->id_comment)->update([
            'is_publish'         => '1',
        ]);

        $reply = CommentModel::where('id_parent', $request->id_comment)->first();
        if ($reply == null) {
            $reply == null;
        }
        return view('admin.comment.show', compact('comment','title', 'reply'));
    }

    public function showRead(Request $request)
    {
        $title = 'comments';
        $comment = CommentModel::select('articles.id_article','articles.title', 'comments.*')
                                ->Join('articles', 'articles.id_article', '=', 'comments.id_article')
                                ->where('id_comments', $request->id_comment)
                                ->first();

        $reply = CommentModel::where('id_parent', $request->id_comment)->first();
        if ($reply == null) {
            $reply == null;
        }
        return view('admin.comment.show', compact('comment','title', 'reply'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reply(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('dashboard/comment')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            CommentModel::create([
                'id_comments'   => Str::uuid(),
                'id_article'    => $request->id_article,
                'name'          => Auth::user()->name,
                'email'         => Auth::user()->email,
                'comments'      => $request->comment,
                'id_parent'     => $request->id_comment,
                'is_publish'    => 1
            ]);

            $notification = array(
                'message' => 'Reply Comment successfully!',
                'alert-type' => 'success'
            );
            
            return Redirect::to('dashboard/comment')->with($notification);

        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = CommentModel::where('id_comments', $id)->delete();
        if (!$comment) {
            $notif = array([
                'message' => 'comment not found',
                'alert-type'    => 'danger'
            ]);

            return redirect()->back()->with($notif);
        }else{
            CommentModel::where('id_comments', $id)->delete();
            CommentModel::where('id_parent', $id)->delete();
            $notification = array(
                'message' => 'Data Delete successfully!',
                'alert-type' => 'success'
            );
            
            return Redirect::to('dashboard/comment')->with($notification);
        }
    }
}
