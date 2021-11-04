<?php

namespace App\Http\Api;

use App\Models\Order;
use App\Models\TransactionModel;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ViettelpostApi{

    public $order, $transaction, $Bearer;

    public function __construct()
    {
        # code...

    }
    public function login()
    {
        # code...
        $username = env('VIETTEL_USERNAME');
        $password = env('VIETTEL_PASSWORD');
        $url = env('VIETTEL_URL');

        $response = Http::post($url, [
            "USERNAME"=>$username,
            "PASSWORD"=>$password
        ]);
        // dd(json_decode($response->body())->data->token);
        return json_decode($response->body())->data->token;
    }
    public function createOrder($order_code)
    {
        # code...
        // $response = Http::withToken('token')->post();
        $url = 'https://partner.viettelpost.vn/v2/order/getPriceAll';


        $user_viettel = Http::post(env('VIETTEL_URL'), [
            "USERNAME"=>env('VIETTEL_USERNAME'),
            "PASSWORD"=>env('VIETTEL_PASSWORD')
        ]);
        // dd(json_decode($user_viettel->body())->data->token);
        $storeAddressUrl = Http::withHeaders(['Token'=>json_decode($user_viettel->body())->data->token])->get('https://partner.viettelpost.vn/v2/user/listInventory');
        $storeData = json_decode($storeAddressUrl->body())->data;
        $storeData = Arr::first($storeData);

        $url = 'https://partner.viettelpost.vn/v2/order/createOrder';
        $order = Order::where('order_code',$order_code)->firstOrFail();
        $transaction = TransactionModel::where('order_id',$order->id)->first();
        $custommer = User::find($order->user_id);
        $listItem = [];
        foreach(json_decode($order->content) as $item){

            $temp["PRODUCT_NAME" ]= $item->name;
            $temp["PRODUCT_PRICE"] = intval($item->price);
            $temp["PRODUCT_WEIGHT"] = 2500;
            $temp["PRODUCT_QUANTITY"] = intval($item->qty);
            array_push($listItem, $temp);
        }
        // dd(Arr::first($listItem));
        $shipping = Http::withHeaders(['Token'=>json_decode($user_viettel->body())->data->token])->post('https://partner.viettelpost.vn/v2/order/getPriceAll',[
            "PRODUCT_WEIGHT"=>7500,
            "PRODUCT_PRICE"=>intval($order->total_price),
            "MONEY_COLLECTION"=>intval($order->total_price),
            "SENDER_PROVINCE"=>intval($storeData->provinceId),
            "SENDER_DISTRICT"=>intval($storeData->districtId),
            "RECEIVER_PROVINCE"=>intval($transaction->province_id),
            "RECEIVER_DISTRICT"=>intval($transaction->district_id),
            "PRODUCT_TYPE"=>"HH",
            "TYPE" =>1
        ]);
        // dd(json_decode($shipping->body()));
        $data = [
            "ORDER_NUMBER" => $order_code,
            "GROUPADDRESS_ID" => intval($storeData->groupaddressId),
            "CUS_ID" => intval($storeData->cusId),
            "DELIVERY_DATE" => gmdate('d/m/Y h:i:s'),
            "SENDER_FULLNAME" => $storeData->name,
            "SENDER_ADDRESS" => $storeData->address,
            "SENDER_PHONE" => $storeData->phone,
            "SENDER_EMAIL" => "",
            "SENDER_WARD" => intval($storeData->wardsId),
            "SENDER_DISTRICT" => intval($storeData->districtId),
            "SENDER_PROVINCE" => intval($storeData->provinceId),
            "SENDER_LATITUDE" => 0,
            "SENDER_LONGITUDE" => 0,
            "RECEIVER_FULLNAME" => $custommer->last_name.' '.$custommer->first_name,
            "RECEIVER_ADDRESS" => $transaction->street ==null ?'null ':$transaction->street,
            "RECEIVER_PHONE" => $transaction->phone,
            "RECEIVER_EMAIL" => "",
            "RECEIVER_WARD" => intval($transaction->ward_id),
            "RECEIVER_DISTRICT" => intval($transaction->district_id),
            "RECEIVER_PROVINCE" => intval($transaction->province_id),
            "RECEIVER_LATITUDE" => 0,
            "RECEIVER_LONGITUDE" => 0,
            "PRODUCT_NAME" => Arr::first($listItem)['PRODUCT_NAME'],
            "PRODUCT_DESCRIPTION" => Arr::first($listItem)['PRODUCT_NAME'],
            "PRODUCT_QUANTITY" => count($listItem),
            "PRODUCT_PRICE" => intval($order->total_price),
            "PRODUCT_WEIGHT" => 7500,
            "PRODUCT_LENGTH" => 38,
            "PRODUCT_WIDTH" => 24,
            "PRODUCT_HEIGHT" => 25,
            "PRODUCT_TYPE" => "HH",
            "ORDER_PAYMENT" => $order->status ==1 ? 2:1,
            "ORDER_SERVICE" => Arr::first(json_decode($shipping->body()))->MA_DV_CHINH,
            "ORDER_SERVICE_ADD" => "",
            "ORDER_VOUCHER" => "",
            "ORDER_NOTE" => "cho xem hàng, không cho thử",
            "MONEY_COLLECTION" => $order->status ==1? intval($order->total_price):0,
            "MONEY_TOTALFEE" => 0,
            "MONEY_FEECOD" => 0,
            "MONEY_FEEVAS" => 0,
            "MONEY_FEEINSURRANCE" => 0,
            "MONEY_FEE" => 0,
            "MONEY_FEEOTHER" => 0,
            "MONEY_TOTALVAT" => 0,
            "MONEY_TOTAL" => intval($order->total_price),
            "LIST_ITEM" => $listItem
            ];
        try{
            $response = Http::withHeaders(['Token'=>json_decode($user_viettel->body())->data->token])->post($url, $data);
            // dd(json_decode($response->body()));
            if(json_decode($response->body())->status == 200){
                $transaction->status= 1;
                $transaction->save();
                return $returnData['RspCode'] = '00';
            }else{
                return $returnData['RspCode'] = '01';
            }
        }catch(Exception $e){

            return $returnData['RspCode'] = '02';
        }


    }
    public function shippingFee($request)
    {
        $url = 'https://partner.viettelpost.vn/v2/order/getPriceAll';

        # code...
        // dd($this->login());
        $storeAddressUrl = Http::withHeaders(['Token'=>$this->login()])->get('https://partner.viettelpost.vn/v2/user/listInventory');
        $storeData = json_decode($storeAddressUrl->body())->data;
        $storeData = Arr::first($storeData);
        $data =[

            "SENDER_PROVINCE" => intval($storeData->provinceId),
            "SENDER_DISTRICT" => intval($storeData->districtId),
            "RECEIVER_PROVINCE" => intval($request->RECEIVER_PROVINCE),
            "RECEIVER_DISTRICT" => intval($request->RECEIVER_DISTRICT),
            "PRODUCT_TYPE" => "HH",
            "PRODUCT_WEIGHT" => 7500,
            "PRODUCT_PRICE" => intval(Str::remove('.',$request->PRODUCT_PRICE)),
            "MONEY_COLLECTION" =>intval(Str::remove('.',$request->PRODUCT_PRICE)),
            "TYPE" =>1
        ];

        $response = Http::withHeaders(['Token'=>$this->login()])->post($url,$data);
        // json_decode($response->body(),true);
        return $response->body();
    }

    public function alldistrict()
    {
        # code...
        $response = Http::get('https://partner.viettelpost.vn/v2/categories/listWards?districtId=-1');
        // dd($response->body());
        echo response($response->body())->header('Content-Type', 'text/plain');
    }
}
