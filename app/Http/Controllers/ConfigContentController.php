<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\MenuModel;
use App\Models\PageModel;
use App\Models\Webinfo;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ConfigContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $curent_choices = json_decode(Webinfo::all()->first()->section);
        if($curent_choices != null){
            $categories = CategoryModel::orderByField('id',$curent_choices)->whereNull('parent')->get();

        }else{
            $categories = CategoryModel::all();
        }

        // $pages = PageModel::whereNull('parent')
        $current_menu_category = json_decode(MenuModel::all()->first()->category);
        $current_menu_page = json_decode(MenuModel::all()->first()->page);
        if($current_menu_page == null){
            $menuPage = PageModel::whereNull('parent')->wherePosition(1)->get();
        }else{
            $menuPage = PageModel::orderByField('id',$current_menu_page)->whereNull('parent')->wherePosition(1)->get();
        }
        if($current_menu_category == null){
            // dd('null');
            $menuCategory = CategoryModel::whereNull('parent')->get();
        }else{
            $menuCategory = CategoryModel::orderByField('id',$current_menu_category)->whereNull('parent')->get();
        }
        // $pages = PageModel::whereNull('parent')->get();
        return view('admin.pages.config_content.index',compact('categories','curent_choices','menuPage','menuCategory','current_menu_category','current_menu_page'));
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

        // $category = CategoryModel::whereIn('id',$request->category)->get();

        $web_config = Webinfo::all()->first();

        $web_config->section = json_encode($request->category);
        $web_config->save();
        Alert::toast('Đã thay đổi cấu hình nội dung','success');
        // dd($request->category,$category);
        return back()->with('success','Thanh cong');


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
