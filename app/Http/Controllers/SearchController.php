<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function ajaxSearch(Request $request)
    {
        # code...
        $keyword = $request->keyword;
        $result = ProductModel::where('name', 'LIKE', "%$keyword%")->get();
        // dd($result);
        return response()->json($result);
    }


    public function search(Request $request)
    {
        # code...
        // dd($request);
        $request->validate([
            'price_from'=>'numeric|min:0',
            'price_to'=>'numeric|min:0',
            'category'=>'numeric',

        ]);
        $categories = CategoryModel::all();
        if($request->has('price_to')){
            $price_from = $request->price_from ==null ? 0: $request->price_from;
            $price_to = $request->price_to ==null ? 10000000000: $request->price_to;

            if($request->category !=null){
                $products = ProductModel::where('name', 'LIKE', "%$request->keyword%")
                ->where('category_id',$request->category)->whereBetween('price',[$price_from,$price_to])->paginate(16);
            }else{
                $products = ProductModel::where('name', 'LIKE', "%$request->keyword%")
                ->whereBetween('price',[$price_from,$price_to])->paginate(16);
            }
        }else{
            $products = ProductModel::where('name', 'LIKE', "%$request->keyword%")->paginate(16);
        }
        return view('user.search_result',compact('categories','products'));
    }
}
