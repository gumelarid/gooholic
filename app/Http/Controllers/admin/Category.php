<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class Category extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Category';
        $category = CategoryModel::all();
        return view('admin.category.index', compact('title','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|unique:categorys',
        ]);

        if ($validator->fails()) {
            return redirect('dashboard/category')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            CategoryModel::create([
                'id_category'       => Str::uuid(),
                'slug_category'          => Str::slug($request->category),
                'category'         => $request->category,
            ]);

            $notification = array(
                'message' => 'category Created successfully!',
                'alert-type' => 'success'
            );
            
            return Redirect::to('dashboard/category')->with($notification);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $category = CategoryModel::find($request->id_category)->first();

        return view('admin.category.edit', compact('category'));
    }

   
    public function update(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'url' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('dashboard/category')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            CategoryModel::where('id_category', $request->id_category)->update([
                'slug_category'          => Str::slug($request->url),
                'category'         => $request->category,
            ]);

            $notification = array(
                'message' => 'category Update successfully!',
                'alert-type' => 'success'
            );
            
            return Redirect::to('dashboard/category')->with($notification);

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
        $category = CategoryModel::find($id)->first();
        if (!$category) {
            $notif = array([
                'message' => 'category not found',
                'alert-type'    => 'danger'
            ]);

            return redirect()->intended('dashboard/category')->with($notif);
        }else{
            $category = CategoryModel::where('id_category', $id)->delete();
            $notification = array(
                'message' => 'category Delete successfully!',
                'alert-type' => 'success'
            );
            
            return Redirect::to('dashboard/category')->with($notification);
        }
    }
}
