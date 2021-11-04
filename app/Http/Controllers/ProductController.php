<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\ProductTypeModel;
use App\Models\ShopModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = ProductModel::join('categories','products.category_id','=','categories.id')->select('products.*','categories.name as cat_name')->get();
        // dd($products->first());
        return view('admin.pages.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $types = CategoryModel::all();
        return view('admin.pages.product.create',compact('types'));
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
            'title'=>'required',
            'slug'=>'required|unique:products,slug',
            'product_code'=>'required|unique:products,sku',
            'product_category'=>'integer|min:1',
            'price'=>'required|integer|min:1000',
            'images'=>'required',
            'avatar'=>'required',
            'short_description'=>'required',
            'description'=>'required',
        ]);
        $images = rtrim($request->images,', ');
        $product = new ProductModel();
        $product->name = $request->title;
        $product->slug = $request->slug;
        $product->sku = $request->product_code;
        $product->avatar = $request->avatar;
        $product->category_id = $request->product_category;
        $product->featured = $request->featured == 'on' ? 1 : 0;
        $product->status = $request->status =='on' ? 1: 0;
        $product->price = $request->price;
        $product->promotion_price = $request->promotion;
        $product->images = json_encode(explode(',',$images));
        $product->short_description = $request->short_description;
        $product->description = $request->description;;
        $product->save();
        // dd($product);

        return redirect()->route('product.index');

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
        $product = ProductModel::findOrFail($id);
        $images = $product->images;
        $image_string = null;
        if(json_decode($images)){
        $image_string = implode(',',json_decode($images));
        }
        $image_string .= ',';
        // dd($image_string);
        $types = CategoryModel::all();
        // $shops = ShopModel::all();
        Alert::toast('Thêm sản phẩm thành công','success');
        return view('admin.pages.product.edit',compact('product','types','image_string'));
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
            'title'=>'required',
            // 'slug'=>'required|unique:products,slug',
            'product_category'=>'integer|min:1',
            'price'=>'required|integer|min:1000',
            'images'=>'required',
            'content'=>'required',
            'short_description'=>'required',
            'avatar'=>'required',
        ]);



        $images = rtrim($request->images,', ');
        $product = ProductModel::where('id',$id)->first();
        if($request->slug != $product->slug){
            $request->validate([
                'slug'=>'required|unique:products,slug'
            ]);
            $product->slug = $request->slug;
        }
        $product->name = $request->title;

        // $product->slug = $request->slug;
        $product->avatar = $request->avatar;
        $product->category_id = $request->product_category;
        $product->featured = $request->featured == 'on' ? 1 : 0;
        $product->status = $request->status == 'on' ? 1 : 0;
        $product->price = $request->price;
        $product->promotion_price = $request->promotion;
        $product->images = json_encode(explode(',',$images));
        $product->short_description = $request->short_description;
        $product->description = $request->content;
        $product->save();
        Alert::toast('Thay đổi thông tin sản phẩm thành công','success');
        return redirect()->route('product.index');
        // dd($request);
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
        $product = ProductModel::find($id)->delete();
        // $product->delete();
        Alert::success('Đã xoá sản phẩm','success');
        return response()->json(['code'=>200]);
    }
    public function delete($id)
    {
        # code...
        $product = ProductModel::find($id)->delete();
        // $product->delete();
        Alert::success('Đã xoá sản phẩm','success');
        return response()->json(['code'=>200]);
    }
}
