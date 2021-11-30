<?php

namespace App\Http\Controllers;

use App\Models\CommentModel;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class Comment extends Controller
{
    public function index(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mail' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }else{
            CommentModel::create([
                'id_comments'    =>  Str::uuid(),
                'id_article'  =>  $request->id_article,
                'name' =>  $request->name,
                'email'       =>  $request->mail,
                'comments'   =>  $request->comment == null ? '' : $request->comment,
                'id_parent'   =>  '',
                'is_publish'       =>  0,
            ]);

            $notification = array(
                'message' => 'Thank you!!. Comment has been send!',
                'alert-type' => 'success'
            );
            
            return redirect()->back()->with($notification);

        }
    }
}
