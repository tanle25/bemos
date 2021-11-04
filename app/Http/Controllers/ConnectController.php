<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\ProductTypeModel;
use App\Models\ShopModel;
use App\Models\SupplyAndDemandModel;
use App\Models\Ward;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Validator;
use Illuminate\Support\Facades\Validator;

class ConnectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $connects = SupplyAndDemandModel::where('status',1)->orderBy('created_at','desc')->get();
        $product_types = ProductTypeModel::all();
        $districts = District::all();
        $shops = ShopModel::join('wards','shops.ward','=','wards.id')->join('districts','shops.district','=','districts.id')
        ->select('shops.*','wards.ward_name','districts.district_name')->where('pos',999)->take(5)->get();
        return view('user.pages.connect',compact('connects','shops','product_types','districts'));
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
        // return response()->json([$request->all(),$request->allFiles()]);
        $validator = Validator::make($request->all(),[
            'info_type'=>'integer|between:1,2',
            'product_name'=>'required',
            'product_type'=>'required',
            'quantity'=>'required',
            'phone'=>'required|digits:10',
            'district'=>'required',
            'ward'=>'required',
            'end_date'=> 'date_format:d/m/Y|after:start_date',
            'start_date'=>'date_format:d/m/Y|after_or_equal:today',
            // 'file'=>'required',
        ]);
        if($validator->passes()){
            try{
                $address = Ward::join('districts','wards.district_id','=','districts.id')->where('wards.id',(int)$request->ward)->first();
                $connect = New SupplyAndDemandModel();
                $connect->type = $request->info_type;
                $connect->name = $request->product_name;
                $connect->type_product_id = $request->product_type;
                $connect->content = $request->quantity;
                $connect->phone = $request->phone;
                $connect->huyen = $request->district;
                $connect->xa = $request->ward;
                $connect->address = $request->address. ', '. $address->ward_name. ', '.$address->district_name;
                $connect->start_date = $request->start_date;
                $connect->end_date = $request->end_date;
                // $connect->images = $request->images;
                $connect->user_id = Auth::user()->id;
                $image = $request->file('file');
                $link = $image->move($image->getClientOriginalName());
                $connect->images = 'images/'.$link;
                // return response()->json(['img'=>$link]);
                $connect->save();
                return response()->json(['code'=>200]);
            }catch(Exception $e){
                return response()->json(['code'=>400,'errors'=>$e]);
            }

        }else{
            return response()->json(['code'=>201,'errors'=>$validator->getMessageBag()->toArray()]);
        }
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
