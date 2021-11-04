<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = CategoryModel::all();
        return view('admin.pages.post_category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = CategoryModel::all();
        return view('admin.pages.post_category.create',compact('categories'));

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
        $request->validate([
            'title'=>'required',
            'slug'=>'required|unique:type_products,slug',
            'status'=>'integer|min:0|max:1',
        ]);
        $category = new CategoryModel();
        $category->name = $request->title;
        $category->slug = $request->slug;
        // $category->banner = $request->image;
        $category->cat_id = $request->parrent;
        $category->status = $request->status;
        $category->save();
        return redirect()->route('post-category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $category = CategoryModel::find($id);
        $categories = CategoryModel::all();
        return view('admin.pages.post_category.edit',compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // dd($request);

        $request->validate([
            'title'=>'required',
            'slug'=>'required|unique:type_products,slug',
            'status'=>'integer|min:0|max:1',
        ]);
        $category = CategoryModel::where('id',$id)->first();
        $category->name = $request->title;
        $category->slug = $request->slug;
        // $category->banner = $request->image;
        $category->cat_id = $request->parrent;
        $category->status = $request->status;
        $category->save();
        return redirect()->route('post-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        CategoryModel::find($id)->delete();
        return response()->json(['code'=>200]);
    }
}
