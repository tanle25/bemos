<?php

namespace App\Http\Controllers;

use App\Models\DocumentModel;
use App\Models\ShopModel;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $documents = DocumentModel::join('shops','shop_docs.shop_id','=','shops.id')->select('shop_docs.*','shops.shop_name')->get();
        return view('admin.pages.document.index',compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $shops = ShopModel::all();
        return view('admin.pages.document.create',compact('shops'));
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
            'name'=>'required',
            'shop'=>'required',
            'image'=>'required',
            'status'=>'required',
        ]);

        $document = new DocumentModel();
        // dd($document);
        $document->name = $request->name;
        $document->shop_id = $request->shop;
        $document->image = $request->image;
        $document->status = $request->status;
        $document->des_s = $request->content;
        $document->save();
        return back();
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
        // dd($id);
        $shops = ShopModel::all();
        $document = DocumentModel::find($id);
        // dd($document);
        return view('admin.pages.document.edit',compact('shops','document'));
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
            'name'=>'required',
            'shop'=>'required',
            'image'=>'required',
        ]);

        $document = DocumentModel::where('id',$id)->first();
        // dd($document);
        $document->name = $request->name;
        $document->shop_id = $request->shop;
        $document->image = $request->image;
        $document->status = $request->status;
        $document->des_s = $request->content;
        $document->save();
        return back();
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
        $document = DocumentModel::where('id',$id);
        $document->delete();
        return response()->json(["code"=>200]);
    }
}
