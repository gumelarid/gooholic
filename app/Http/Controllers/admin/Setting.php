<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SettingModel;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class Setting extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Setting';
        $setting = SettingModel::all()->first();

        return view('admin.setting.index', compact('title','setting'));

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
        if ($request->file != null) {
            $validator = Validator::make($request->all(), [
                'name_web' => 'required',
                'description' => 'required',
                'file' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'name_web' => 'required',
                'description' => 'required',
            ]);
        }

        
        if ($validator->fails()) {
            return redirect('dashboard/setting')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $setting = SettingModel::all()->first();
            if ($setting == null) {
                if ($request->file == null) {
                    SettingModel::create([
                        'id_web'    =>  Str::uuid(),
                        'logo'  =>  '',
                        'name_web' =>  $request->name_web,
                        'description'   =>  $request->description,
                    ]);
                } else {
                    $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('file')->getClientOriginalName());
                    $request->file('file')->move(public_path('assets/image/'), $filename);

                    SettingModel::create([
                        'id_web'    =>  Str::uuid(),
                        'logo'  =>  $filename,
                        'name_web' =>  $request->name_web,
                        'description'   =>  $request->description,
                    ]);
                }
            }else{
                if ($request->file == null) {
                    SettingModel::where('id_web', $setting->id_web)->update([
                        'name_web' =>  $request->name_web,
                        'description'   =>  $request->description,
                    ]); 
                } else {
                    $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('file')->getClientOriginalName());
                    $request->file('file')->move(public_path('assets/image/'), $filename);

                    SettingModel::where('id_web', $setting->id_web)->update([
                        'logo'  =>  $filename,
                        'name_web' =>  $request->name_web,
                        'description'   =>  $request->description,
                    ]);
                }
            }

            $notification = array(
                'message' => 'Save Setting successfully!',
                'alert-type' => 'success'
            );
            
            return Redirect::to('dashboard/setting')->with($notification);

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
        $setting = SettingModel::find($id)->first();
        if (!$setting) {
            $notif = array([
                'message' => 'Data not found',
                'alert-type' => 'danger'
            ]);

            return redirect()->intended('dashboard/setting')->with($notif);
        }else{
            if ($setting->logo) {
                unlink('assets/image/'.$setting->logo);
            };
            SettingModel::where('id_web', $id)->update([
                'logo'  =>  ''
            ]);
            $notification = array(
                'message' => 'Delete logo successfully!',
                'alert-type' => 'success'
            );
            
            return Redirect::to('dashboard/setting')->with($notification);
        }
    }
}
