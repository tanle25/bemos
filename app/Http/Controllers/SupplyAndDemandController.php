<?php

namespace App\Http\Controllers;

use App\Models\SupplyAndDemandModel;
use Illuminate\Http\Request;

class SupplyAndDemandController extends Controller
{
    //
    public function index(Request $request)
    {
        # code...
        $supplys = SupplyAndDemandModel::join('users','threads.user_id','=','users.id')->select('threads.*','users.name as person')->get();
        return view('admin.pages.supplyanddemand.index',compact('supplys'));
    }
    public function update($id)
    {
        # code...
        $supply = SupplyAndDemandModel::where('id',$id)->first();
        // dd($supply);
        if($supply->status==1){
            $supply->status =2;
        }else{
            $supply->status = 1;
        }
        $supply->save();
        return back();

    }
}
