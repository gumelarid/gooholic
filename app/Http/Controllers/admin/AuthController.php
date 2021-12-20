<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\UserModel;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showFormLogin()
    {
        $title = "Wellcome Bro!!";
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            $notification = array(
                'message' => 'Wellcome back '.Auth::user()->name.' !',
                'alert-type' => 'info'
            );
            
            return Redirect::to('/dashboard')->with($notification);
        }
        return view('admin.login', compact('title'));
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect('/administrator')
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];

        Auth::attempt($data);

        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            $notification = array(
                'message' => 'Wellcome back '.Auth::user()->name.' !',
                'alert-type' => 'info'
            );
            
            return Redirect::to('/dashboard')->with($notification);

        } else { // false

            //Login Fail
            $notification = array(
                'message' => 'Wrong password !',
                'alert-type' => 'success'
            );
            
            return Redirect::to('/administrator')->with($notification);
        }

    }

    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif

        $notification = array(
            'message' => 'Thank you Bro !',
            'alert-type' => 'success'
        );
        
        return Redirect::to('/administrator')->with($notification);
    }
    
}
