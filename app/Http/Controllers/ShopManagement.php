<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\ShopModel;
use App\Models\Ward;
use Illuminate\Http\Request;

class ShopManagement extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $shops = ShopModel::all();
        return view('admin.pages.shop.index',compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $districts = District::all();
        return view('admin.pages.shop.create',compact('districts'));
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
            'email'=>'required|unique:shops,email|email',
            'username'=>'required|unique:shops,username',
            'password'=>'min:8|required|confirmed',
            'shop_name'=>'required',
            'district'=>'required',
            'ward'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'career'=>'required',
            'document_type'=>'required',
            'document_number'=>'required',
            'document_date'=>'required',
            'organ'=>'required',
            'image1'=>'required',
            'person'=>'required',
            'scale'=>'required',
            'avatar'=>'required',
        ]);

        $shop = new ShopModel();

        $shop->email=$request->email;
        $shop->username = $request->username;
        $shop->password = $request->password;
        $shop->status = $request->status;
        $shop->shop_name = $request->shop_name;
        $shop->district = $request->district;
        $shop->ward = $request->ward;
        $shop->address = $request->address;
        $shop->phone = $request->phone;
        $shop->nganhql = $request->career;
        $shop->document_type = $request->document_type;
        $shop->document_number = $request->document_number;
        $shop->document_date = $request->document_date;
        $shop->document_place = $request->organ;
        $shop->shop_document_img1 = $request->image1;
        $shop->shop_document_img2 = $request->image2;
        $shop->nguoidaidien = $request->person;
        $shop->quymo = $request->scale;
        $shop->shop_avatar = $request->avatar;
        $shop->description = $request->content;
        $shop->map = $request->map;
        $shop->website = $request->website;
        $shop->fanpage = $request->fanpage;
        $shop->save();
        return redirect()->route('shop.index');
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
        $districts = District::all();
        $shop = ShopModel::find($id);
        return view('admin.pages.shop.edit',compact('shop','districts'));
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

            'shop_name'=>'required',
            'district'=>'required',
            'ward'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'career'=>'required',
            'document_type'=>'required',
            'document_number'=>'required',
            'document_date'=>'required',
            'organ'=>'required',
            'image1'=>'required',
            'person'=>'required',
            'scale'=>'required',
            'avatar'=>'required',
        ]);
        $shop = ShopModel::where('id',$id)->first();

        // dd($request->email, $shop->email);



        if($request->emai == $shop->email){
            $request->validate(['email'=>'required|unique:shops,email|email']);
            $shop->email=$request->email;
        }
        if($request->username != $shop->username){
            $request->validate(['username'=>'required|unique:shops,username']);
            $shop->username = $request->username;
        }

        if($request->password !=null){
            $request->validate(['password'=>'min:8|required|confirmed']);
            $shop->password = $request->password;
        }
        $shop->shop_name = $request->shop_name;
        $shop->district = $request->district;
        $shop->ward = $request->ward;
        $shop->address = $request->address;
        $shop->phone = $request->phone;
        $shop->nganhql = $request->career;
        $shop->document_type = $request->document_type;
        $shop->document_number = $request->document_number;
        $shop->document_date = $request->document_date;
        $shop->document_place = $request->organ;
        $shop->shop_document_img1 = $request->image1;
        $shop->shop_document_img2 = $request->image2;
        $shop->nguoidaidien = $request->person;
        $shop->quymo = $request->scale;
        $shop->shop_avatar = $request->avatar;
        $shop->description = $request->content;
        $shop->map = $request->map;
        $shop->website = $request->website;
        $shop->fanpage = $request->fanpage;
        $shop->save();
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
        $shop = ShopModel::where('id',$id)->first();
        $shop->delete();
        return response()->json(['code'=>200]);
    }

}
