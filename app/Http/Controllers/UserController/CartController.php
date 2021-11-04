<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\ProvinceModel;
use Exception;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items = Cart::content();
        // dd($items);
        $provinces = ProvinceModel::all();
        return view('user.cart',compact('items','provinces'));
        // dd(Cart::content());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        Cart::destroy();
        return back();
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

        try{
            $item =  Cart::add([
                'id'=>$request->product_id,
                'name'=>$request->product_name,
                'qty'=>$request->quantily,
                'price'=>$request->product_promotion ==null ?$request->product_price:$request->product_promotion,
                'weight' => 550,
                'options' => [
                    'price'=>$request->product_price,
                    'promotion' => $request->product_promotion,
                    'sku' => $request->product_sku,
                    'avatar'=>$request->product_avatar,
                    'slug'=>$request->product_slug,
                ]
            ]);
            Alert::toast('Thêm vào giỏ hàng thành công','success');
            return redirect()->back();
        }catch(Exception $e){
            Alert::toast('Có lỗi khi thêm đơn hàng','error');
            return redirect()->back();
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
        $request->validate([
            'quantily.*'=>'required|numeric|min:1'
        ]);

        // UPDATE QUANTILY
        try{
            foreach($request->quantily as $key=> $quantiy){
                // dd($key);
                Cart::update($key,['qty'=>$quantiy]);
            }

            if($request->delete){
                foreach($request->delete as $delete){
                    Cart::remove($delete);
                }
            }
            Alert::toast('Cập nhật giỏ hàn thành công','success');
            return redirect()->back();
        }catch(Exception $e){
            Alert::toast('Có lỗi khi thêm đơn hàng','error');
            return redirect()->back();
        }
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
    public function removeItem($item)
    {
        # code...
        Cart::remove($item);
        Alert::toast('Xoá thành công','success');
        return redirect()->back()->with(['success'=>'Xoá thành công']);
    }
}
