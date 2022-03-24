<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductTypeModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
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
        // dd($categories->first());
        return view('admin.pages.category.index',compact('categories'));
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
        return view('admin.pages.category.create',compact('categories'));
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
        // dd($request);
        $request->validate([
            'title'=>'required',
            'slug'=>'required|unique:categories,slug',
            'image'=>'required',
            'slider'=>'required',
        ]);
        $category = new CategoryModel();
        $category->name = $request->title;
        $category->slug = $request->slug;
        $category->banner = $request->image;
        $category->image = $request->slider;
        $category->parent = $request->parrent;
        $category->status = $request->status == 'on' ? 1 :0;
        $category->color = $request->color;
        $category->description = $request->desc;
        $category->save();
        return redirect()->route('category.index');
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

        $all = CategoryModel::all();
        $check = CategoryModel::find($id)->categories;
        dd($check);
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
        // dd($category);
        return view('admin.pages.category.edit',compact('category','categories'));
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
        // $parrent = $request->parrent==0? null : $request-> parrent;
        // dd($parrent);
        $request->validate([
            'title'=>'required',
            'image'=>'required',
            'slider'=>'required',
        ]);
        $category = CategoryModel::find($id);
        $category->name = $request->title;
        $category->slug = $request->slug;
        $category->banner = $request->image;
        $category->image = $request->slider;
        $category->parent = $request->parrent;
        $category->status = $request->status =='on' ? 1 : 0;
        $category->color = $request->color;
        $category->description = $request->desc;
        $category->save();
        Alert::toast('Đã cập nhật danh mục','success');
        return redirect()->route('category.index');
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
