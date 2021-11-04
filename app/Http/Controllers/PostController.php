<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\PostModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Postmodel::all();
        return view('admin.pages.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.post.create');
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
            'title' =>'required',
            'slug'=>'required',
            'short_description' => 'required',
            'content'=>'required',
            'avatar'=>'required',
        ]);

        $post = new PostModel();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->description = $request->short_description;
        $post->content = $request->content;
        $post->avatar = $request->avatar;
        $post->status = $request->status == 'on' ? 1: 0;
        $post->save();
        return redirect()->route('post.index')->with(['success'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostModel  $postModel
     * @return \Illuminate\Http\Response
     */
    public function show(PostModel $postModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostModel  $postModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // dd($id);
        $post = PostModel::find($id);
        return view('admin.pages.post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostModel  $postModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //
        // dd($request);

        $post = PostModel::where('id',$id)->first();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->description = $request->short_description;
        $post->content = $request->content;
        $post->avatar = $request->avatar;
        $post->status = $request->status == 'on' ? 1: 0;
        $post->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostModel  $postModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        PostModel::find($id)->delete();
        return response()->json(['code'=>200]);
    }
}
