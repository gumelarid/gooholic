<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class User extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'List User';
        $user = UserModel::all();
        return view('admin.user.index', compact('title','user'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Add User';
        return view('admin.user.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return redirect('dashboard/user/add')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            UserModel::create([
                'id_user'       => Str::uuid(),
                'name'          => $request->name,
                'email'         => $request->email,
                'password'      => Hash::make($request->password),
                'is_active'     => 1,
                'role'          => $request->role,
                'profile'       => 'user.png'
            ]);

            $notification = array(
                'message' => 'User Created successfully!',
                'alert-type' => 'success'
            );
            
            return Redirect::to('/dashboard/user')->with($notification);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $title = 'Edit User';
        $user = UserModel::find($id)->first();
        if (!$user) {
            $notification = array(
                'message' => 'User not found!',
                'alert-type' => 'danger'
            );
            
            return Redirect::to('/dashboard/user')->with($notification);
        }

        return view('admin.user.edit', compact('title','user'));

    }

    public function profile($id)
    {
        //
        $title = 'Profile';
        $user = UserModel::find($id)->first();
        if (!$user) {
            $notification = array(
                'message' => 'User not found!',
                'alert-type' => 'danger'
            );
            
            return Redirect::to('/dashboard/profile/'.$id)->with($notification);
        }

        return view('admin.user.profile', compact('title','user'));

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
        //
        if ($request->password != null) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required|min:8'
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required'
            ]);
        }

        
        if ($validator->fails()) {
            return redirect('dashboard/user/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
        }else{
            if ($request->password != null) {
                UserModel::where('id_user', $request->id)->update([
                    'name'          => $request->name,
                    'email'         => $request->email,
                    'password'      => Hash::make($request->password),
                    'role'          => $request->role,
                ]);    
            }else{
                UserModel::where('id_user', $request->id)->update([
                    'name'          => $request->name,
                    'email'         => $request->email,
                    'role'          => $request->role,
                ]);    
            }

            $notification = array(
                'message' => 'User Update successfully!',
                'alert-type' => 'success'
            );
            
            return Redirect::to('/dashboard/user')->with($notification);

        }

    }

    public function updateProfile(Request $request)
    {
        //
        if ($request->password != null) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required|min:8'
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required'
            ]);
        }

        
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }else{
            if ($request->password != null) {
                UserModel::where('id_user', $request->id)->update([
                    'name'          => $request->name,
                    'email'         => $request->email,
                    'password'      => Hash::make($request->password),
                ]);    
            }else{
                UserModel::where('id_user', $request->id)->update([
                    'name'          => $request->name,
                    'email'         => $request->email,
                ]);    
            }

            $notification = array(
                'message' => 'Profile Update successfully!',
                'alert-type' => 'success'
            );
            
            return Redirect::to('/dashboard/profile/'.$request->id)->with($notification);

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
        $user = UserModel::find($id)->first();
        if (!$user) {
            $notif = array([
                'message' => 'User not found',
                'alert-type'    => 'danger'
            ]);

            return redirect()->intended('dashboard/user')->with($notif);
        }else{
            $user = UserModel::where('id_user', $id)->delete();
            $notification = array(
                'message' => 'User Delete successfully!',
                'alert-type' => 'success'
            );
            
            return Redirect::to('/dashboard/user')->with($notification);
        }
    }
}
