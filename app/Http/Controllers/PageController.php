<?php

namespace App\Http\Controllers;

use App\Models\PageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pages = PageModel::all();
        return view('admin.pages.pages.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pages = PageModel::whereParent(null)->get();
        return view('admin.pages.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getSlug(Request $request)
    {
        # code...
        $slug = Str::slug($request->title, '-');
        // dd($slug);
        return $slug;
    }
    public function store(Request $request)
    {
        //
        // dd($request);
        $request->validate([
            "title" => 'required',
            "slug" => 'required|unique:pages,slug',
            "content" => 'required',
        ]);
        $page = new PageModel();
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->content = $request->content;
        $page->status = $request->status == 'on'? 1:0;
        $page->position = $request->position;
        $page->parent = $request->parent;
        $page->save();
        Alert::toast('Đã Tạo trang','success');
        return redirect()->route('page.index');
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
        // dd($id);
        $page = PageModel::whereSlug($id)->firstOrFail();
        // dd($page->parent);
        return view('user.introduce',compact('page'));
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
        $page = PageModel::find($id);
        return view('admin.pages.pages.edit', compact('page'));
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
        $request->validate([
            "title" => 'required',

            "content" => 'required',
        ]);
        $page = PageModel::where('id',$id)->first();
        if($page->slug !=$request->slug){
            $request->validate([
                "slug" => 'required|unique:pages,slug',
            ]);
            $page->slug = $request->slug;
        }
        $page->title = $request->title;

        $page->content = $request->content;
        $page->status = $request->status == 'on'? 1:0;
        $page->position = $request->position;
        $page->parent = $request->parent;
        $page->save();
        Alert::toast('Đã cập nhậ trang '.$page->title ,'success');
        return redirect()->route('page.index');
        // dd($id);
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


        $page = PageModel::find($id);
         $page->delete();
         Alert::toast('Đã xoá' ,'success');
        return response()->json(['code'=>'200']);
    }
}
