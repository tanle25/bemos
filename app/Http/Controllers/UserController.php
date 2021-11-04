<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\ProvinceModel;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('admin.pages.user.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $provinces = ProvinceModel::all();
        return view('admin.pages.user.user.create',compact('provinces'));
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
            "gender"=>'required|in:male,female',
            "phone" => "required|digits:10",
            "last_name" => "required",
            "first_name" => "required",
            "email" => "required",
            "province" => "required",
            "district" => "required",
            "birth_day" => "required",
            "avatar" => "required",
            'password'=>'required|min:8',

        ],[],[
            "phone" =>'Số điện thoại',
            "last_name" =>'Tên',
            "first_name" =>'Họ',
            "province" =>'Tỉnh',
            "district" =>'Huyện',
            "birth_day" =>'Ngày sinh',
            "password" =>'Mật khẩu',
            "avatar" =>'Avatar'
        ]);
        $user = new User();
        $user->gender = $request->gender;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->province = $request->province;
        $user->district = $request->district;
        $user->ward = $request->ward;
        $user->street = $request->street;
        $user->birthday = $request->birth_day;
        $user->avatar = $request ->avatar;
        $user->status = $request->status =='on'?1:0;
        $user->password= Hash::make($request->password);
        $user->email= $request->email;
        $user->phone= $request->phone;
        $user->save();
        Alert::toast('Đã thêm thành viên','success');
        return redirect()->route('user-info.index');
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
        $user = User::find($id);
        $provinces = ProvinceModel::all();
        $district = District::find($user->district);
        $ward = Ward::find($user->ward);
        // dd($district);
        return view('admin.pages.user.user.edit',compact('provinces','user','district','ward'));
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
            "phone" => "required|digits:10",
            "last_name" => "required",
            "first_name" => "required",
            "email" => "required",
            "province" => "required",
            "district" => "required",
            "birth_day" => "required",
            "avatar" => "required",

        ],[],[
            "phone" =>'Số điện thoại',
            "last_name" =>'Tên',
            "first_name" =>'Họ',
            "province" =>'Tỉnh',
            "district" =>'Huyện',
            "birth_day" =>'Ngày sinh',
            "password" =>'Mật khẩu',
            "avatar" =>'Avatar'
        ]);
        $user = User::find($id);
        if($request->password){
            $request->validate([
                'password'=>'min:8',
            ]);
            $user->password= Hash::make($request->password);
        }
        if($request->email != $user->email){
            $request->validate([
                'email'=>'email|unique:users,email',
            ]);
            $user->email= $request->email;
        }
        if($request->phone != $user->phone){
            $request->validate([
                'phone'=>'digits:10|unique:users,phone',
            ]);
            $user->phone= $request->phone;
        }
        // dd($user);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->province = $request->province;
        $user->district = $request->district;
        $user->ward = $request->ward;
        $user->street = $request->street;
        $user->birthday = $request->birth_day;
        $user->avatar = $request ->avatar;
        $user->status = $request->status =='on'?1:0;
        $user->save();
        Alert::toast('Cập nhật thông tin thành công','success');
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
        User::destroy($id);
        return response()->json(['code'=>200]);
    }
}
