<?php

namespace App\Http\Controllers;

use App\Models\Webinfo;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class WebsiteConfig extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $web_info = Webinfo::all()->first();
        //  dd($web_info);
        return view('admin.pages.settingwebsite.info',compact('web_info'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'logo'=>'required',
            'logo_footer'=>'required',
            'favicon'=>'required'
        ]);
        $info= Webinfo::all()->first();
        $info->site_name = $request->title;
        $info->desciption = $request->desciption;
        $info->address = $request->address;
        $info->factory_address = $request->factory_address;
        $info->logo =$request->logo;
        $info->footer_logo =$request->logo_footer;
        $info->favicon =$request->favicon;
        $info->hotline = $request->hotline;
        $info->phone = $request->phone;
        $info->maketing_phone = $request->maketting;
        $info->email = $request->email;
        $info->facebook = $request->facebook;
        $info->google = $request->google;
        $info->zalo = $request->zalo;
        $info->skype = $request->skype;
        $info->youtube = $request->youtube;
        $info->save();
        Alert::toast('Đã cập nhật thông tin website','success');
        return redirect()->back();
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
    }
}
