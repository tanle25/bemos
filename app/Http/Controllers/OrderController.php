<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use App\Models\TransactionModel;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Expr\AssignOp\Concat;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = OrderModel::join('users','orders.user_id','=','users.id')
        ->join('transactions','transactions.order_id','=','orders.id')
        ->join('province','transactions.province_id','=','province.PROVINCE_ID')
        ->join('district','transactions.district_id','=','district.DISTRICT_ID')
        ->join('ward','transactions.ward_id','=','ward.WARDS_ID')
        ->select('orders.*','users.last_name','users.first_name','users.email','province.PROVINCE_NAME as province','district.DISTRICT_NAME as district','ward.WARDS_NAME as ward','transactions.street','transactions.phone','transactions.status as transactionStatus','transactions.vt_status','transactions.order_number')
        ->latest()->get();

        // dd($orders);
        return view('admin.pages.order.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // Cart::store(Auth::user()->id);
        // Cart::restore(Auth::user()->id);
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $order = OrderModel::join('users','orders.user_id','=','users.id')
        ->join('transactions','transactions.order_id','=','orders.id')
        ->join('province','transactions.province_id','=','province.PROVINCE_ID')
        ->join('district','transactions.district_id','=','district.DISTRICT_ID')
        ->join('ward','transactions.ward_id','=','ward.WARDS_ID')
        ->select('orders.*','users.last_name','users.first_name','users.email','province.PROVINCE_NAME as province','province.PROVINCE_ID','district.DISTRICT_NAME as district','district.DISTRICT_ID','ward.WARDS_NAME as ward','ward.WARDS_ID','transactions.street','transactions.phone')
        ->where('orders.id',$request->product_id)->first();
        return response()->json($order);
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
        Cart::destroy();
        $order = OrderModel::join('users','orders.user_id','=','users.id')
        ->join('transactions','transactions.order_id','=','orders.id')
        ->join('province','transactions.province_id','=','province.PROVINCE_ID')
        ->join('district','transactions.district_id','=','district.DISTRICT_ID')
        ->join('ward','transactions.ward_id','=','ward.WARDS_ID')
        ->select('orders.*','users.last_name','users.first_name','users.email','province.PROVINCE_NAME as province','district.DISTRICT_NAME as district','ward.WARDS_NAME as ward','transactions.street','transactions.phone')
        ->where('orders.id',$id)->first();

        // dd(Cart::content());
        return view('admin.pages.order.edit',compact('order'));
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
        Cart::destroy();
        $order = OrderModel::find($id);
        $cart_items = json_decode($order->content);

        foreach($cart_items as $item){
            Cart::add([
                'id'=>$item->id,
                'name'=>$item->name,
                'qty'=>$request->quantily[$item->rowId],
                'price'=>$item->price,
                'weight' => 550,
                'options' => [
                    'promotion' => $item->options->promotion,
                    'sku' => $item->options->sku,
                    'avatar'=>$item->options->avatar,
                    'slug'=>$item->options->slug,
                ]
            ]);
        }

        $order = OrderModel::where('id',$id)->first();
        $order->total_price = Cart::priceTotal(0,'','','');
        $order->content = json_encode(Cart::content());
        $order->save();
        Cart::destroy();
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
        $transaction =  TransactionModel::where('order_id',$id)->first();
        if($transaction->vt_status == -15|| $transaction->vt_status == 107){
            $response = Http::withHeaders(['Token'=>$this->login()])->post('https://partner.viettelpost.vn/v2/order/UpdateOrder',[
                "TYPE" => 11,
                "ORDER_NUMBER" => $transaction->order_number,
                "NOTE" => "Huy"
            ]);
            if(json_decode($response->body())->status == 200){
                $transaction->delete();
                $order = OrderModel::where('id',$id)->first();
                $order->delete();
                return response()->json(['code'=>200]);
            }else{
                return response()->json(['code'=>201,'message'=>json_decode($response->body())->message]);

            }
        }
        $transaction->delete();
        $order = OrderModel::where('id',$id)->first();
        $order->delete();
        return response()->json(['code'=>200]);
    }
}
