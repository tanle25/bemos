<?php
namespace App\Http\Api;
use App\Models\TransactionModel;
use Spatie\WebhookClient\Models\WebhookCall;
use Spatie\WebhookClient\ProcessWebhookJob;

class ViettelWebhook extends ProcessWebhookJob{
    public function handle()
    {
        # code...
        //logger('test');
        $data = json_decode($this->webhookCall, true)['payload']['DATA'];
        $transaction = TransactionModel::where('order_number',$data['ORDER_NUMBER'])->first();
        if($transaction !=null){
            $transaction->vt_status = intval($data['ORDER_STATUS']);
            $transaction->save();
        }
WebhookCall::find(json_decode($this->webhookCall, true)['id'])->first()->delete();
    }
}
