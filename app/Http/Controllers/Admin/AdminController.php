<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Admin;
use App\Models\AdminModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admins = AdminModel::all();
        return view('admin.pages.user.admin.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions = Permission::where('guard_name','admin')->get();

        return view('admin.pages.user.admin.create',compact('permissions'));
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
            'email'=>'required|unique:admins,email',
            'password'=>'required|min:8',
            'phone'=>'required|digits:10|unique:admins,phone',
            'status'=>'required|in:on,off'
        ],[],[
            'name'=>'Tên quản trị viên',
            'password'=>' Mật khẩu',
            'phone' =>'Số điện thoại'
        ]);
        $admin = new AdminModel();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->password = Hash::make($request->password);
        $admin->status = $request->status == 'on'? 1:0;
        $admin->save();
        $admin->syncPermissions($request->permissions);
        // dd($request);
        Alert::toast('Thêm quản trị viên thành công', 'success');
        return redirect()->route('admin-permission.index');

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

        // $admin = Auth::guard('admin')->user();
        // $admin ->assignRole('supper admin');
        // $role = AdminModel::with('roles')->get();
        // dd($admin->getAllPermissions());


        $admin = AdminModel::find($id);
        $permissions = Permission::where('guard_name','admin')->get();
        // $roles = Role::all();
        // dd($permissions, $admin->getAllPermissions());
        return view('admin.pages.user.admin.edit',compact('admin','permissions'));
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
            'email'=>'required',

        ],[],
        [
            'name'=>'Tên quản trị viên',
            'password'=>' Mật khẩu',
            'phone' =>'Số điện thoại'
        ]);
        $admin = AdminModel::find($id);

        if($request->email != $admin->email){
            $request->validate([
                'email'=>'unique:admins,email|email'
            ]);
            $admin->email = $request->email;
        }
        if($request->phone != $admin->phone){
            $request->validate([
                'phone'=>'required|digits:10|unique:admins,phone',
            ]);
            $admin->phone = $request->phone;
        }
        if($request->password != null){
            $request->validate([
                'password'=>'min:8'
            ]);
            $admin->password = Hash::make($request->password);
        }
        // dd($request);

        $admin->status = $request->status == 'on'? 1:0;
        $permissions = $request->permissions;
        // $admin->syncPermissions();
        $admin->syncPermissions($permissions);
        $admin->save();

        Alert::toast('Thay đổi thông tin thành công', 'success');
        return redirect()->route('admin-permission.index')->with(['success'=>'Thay đổi thông tin thành công']);
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
