<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\VNPayService;
use App\Mail\MailNotify;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderModel;
use App\Models\ProvinceModel;
use App\Models\TransactionModel;
use App\Models\Ward;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $request->validate([
            'check'=>'required'
        ],[
            'check.required'=>'Bạn phải đồng ý với điều khoản dịch vụ của chúng tôi'
        ]);
        $provinces = ProvinceModel::all();
        if(Cart::content()->count()<=0){
            return redirect()->back()->with(['error'=>'Không có sản phẩm trong giỏ hàng. không thể tiến hành thanh toán']);

        }else{
            return view('user.checkout',compact('provinces'));
        }

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
            'payment'=>'required|in:0,1',
            "last_name" => 'required',
            "first_name" => 'required',
            "email" => 'required|email',
            "phone" => 'required',
            "province" => 'required',
            "district" => 'required',
            "ward" => 'required',

        ]);
            $oldOrder = OrderModel::where('content','like','%'.Cart::content()->keys()->first().'%')->first();
        // dd($oldOrder);
        if($oldOrder !=null){
            TransactionModel::where('order_id',$oldOrder->id)->delete();
            $oldOrder->delete();
        }
            $order = new OrderModel();
            $order->order_code = time();
            $order->total_price = Cart::priceTotal(0,'','','');
            $order->user_id = Auth::user()->id;
            $order->content = json_encode(Cart::content());
            $order->final_price = intval(Cart::priceTotal(0,'','',''))+intval($request->shipping);
            $order->save();

            // dd($request);
            // STORE TRANSACTION
            $transaction = new TransactionModel();
            $transaction->user_id = Auth::user()->id;
            $transaction->phone = $request->phone;
            $transaction->order_id = $order->id;
            $transaction->province_id = $request->province;
            $transaction->district_id = $request->district;
            $transaction->ward_id = $request->ward;
            $transaction->street = $request->street;
            $transaction->shipping = $request->shipping;
            $transaction->save();
        try{
            $ward = Ward::where('WARDS_ID',$request->ward)->firstOrFail();
            $district = District::where('DISTRICT_ID',$request->district)->firstOrFail();
            $province = ProvinceModel::where('PROVINCE_ID',$request->province)->firstOrFail();
            $street = $request->street == null ? '': $request->street.', ';
            $data = new OrderData();
            $data->address = $street.$ward->WARDS_NAME.', '.$district->DISTRICT_NAME.', '.$province->PROVINCE_NAME;
            $data->payment_method = $request->payment;
            $data->order_code = $order->order_code;
            $data->phone = $request->phone;
            $data->cart = Cart::content();
            $data->cart_total = Cart::priceTotal(0,',',',','.');
            $data->email = $request->email;
            $data->shipping = $request->shipping;
            session(['email_data'=>$data]);
            // dd($data->cart['fc6327576b5f17509f6c748a6b8524e2']->options['avatar']);
            if($request->payment == 1){
                $vnp_Url = new VNPayService();
                $url = $vnp_Url->createRequest($order);
                // dd($url);
                return redirect($url);
            }else{

                Cart::destroy();
                Mail::to($request->email)->send(new MailNotify($data));
                return view('user.thanks');
            }


        }catch(Exception $e){
           dd($e);
        }
        // dd($request);
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
    function paymentreturn(Request $request)
    {
            if($request->vnp_ResponseCode == "00"){
                if(Session::has('email_data')){
                    $data =  session('email_data');
                    Mail::to($data->email)->send(new MailNotify($data));
                    $request->session()->forget('email_data');
                }
                Cart::destroy();
                return view('user.thanks');
            }else{
                return view('user.error');
            }

    }
    public function ipnUrl()
    {
        # code...
        return response(VNPayService::ipnURL())->header('Content-Type', 'text/plain');
    }
    public function Vnpay()
    {
        # code...
        return response(VNPayService::ipnURL())->header('Content-Type', 'text/plain');
    }
}
class OrderData {
    public $address,$payment_method,$order_code,$phone,$cart,$cart_total,$shipping = 0, $email;

    // public function __construct($address,$payment_method,$order_code,$phone,$cart)
    // {
    //     //
    //     $this->address = $address;
    //     $this->payment_method = $payment_method;
    //     $this->order_code = $order_code;
    //     $this->phone = $phone;
    //     $this->cart = $cart;
    // }
    public function __construct()
    {
        //

    }
}
