<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ShopModel;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class ShoploginController extends Controller
{
    // show form login

    public function Index()
    {
        # code...
        return view('shop.auth.login');
    }

    //SHOW FORM REGISTER
    public function IndexRegister()
    {
        # code...

        $ward_list = Ward::all();
        return view('shop.auth.shopregister',compact('ward_list'));

    }

    // LOGIN POST REQUEST

    public function Login(Request $request)
    {
        # code...

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        if (Auth::guard('shop')->attempt([$fieldType=>$request->username, 'password'=>$request->password])) {
            if ($request->expectsJson()) {
                return response()->json(['success' => 'Đăng nhập thành công'], 200);
            }
            return redirect()->route('home')->with(['success' => 'Chào mừng ' . Auth::guard('shop')->user()->shop_name]);
        }

        return back()->withInput()->withErrors(['login_fail' => ['Thông tin đăng nhập sai!']]);
    }



    // REGISTER POST REQUEST

    public function Register(Request $request)
    {
        # code...

        $request->validate([
            'email' => 'email|required|string|max:50|unique:shops,email',
            'phone' => 'required|string|max:256|min:4|unique:shops,phone',
            'password'=>'required|string|min:8|confirmed|max:999999999999',
            'shop_name' =>'required|min:8|string',
            'shop_ward' =>'required|string',
            'shop_type' => 'required',
            'shop_certificate'=> 'required',
            'certificate_no'=> 'required',
            'certificate_place'=> 'required',
            'certificate_date'=> 'required',
            'shop_avatar'=> 'required',
            'certificate_img1'=> 'required',


        ], [
            'phone.max' => "Số điện thoại không đúng định dạng",
        ]);
        $address = DB::table('districts')
        ->join('wards', 'districts.id', '=', 'wards.district_id')->where('wards.id',$request->shop_ward)
        ->get();
        $full_address = $request->shop_address.', xã '. $address->first()->ward_name.', huyện '. $address->first()->district_name;


        $avatar = $request->shop_avatar;
        $shop_document1 = $request-> certificate_img1;
        $shop_document2 = $request-> certificate_img2;
        $avatar_path = $avatar->move('images',time().'_'.$avatar->getClientOriginalName());
        $shop_document_path1 = $shop_document1->move('images',time().'_'.$shop_document1->getClientOriginalName());
        $shop_document_path2 = $shop_document2->move('images',time().'_'.$shop_document2->getClientOriginalName());



        $user = ShopModel::create([
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'shop_name'=>$request->shop_name,
            'shop_type'=>$request->shop_type,
            'ward'=>$request->shop_ward,
            'address'=>$full_address??'',
            'desription'=>'',
            'document_type'=>$request->shop_certificate,
            'document_number'=>$request->certificate_no,
            'document_place'=>$request->certificate_place,
            'document_dae'=>$request->certificate_date,
            'shop_avatar' =>$avatar_path,
            'shop_document_img1'=>$shop_document_path1,
            'shop_document_img2'=>$shop_document_path2,
        ]);
        $user->assignRole('shop');
        Auth::login($user);
        return redirect()->route('home');
    }
}
