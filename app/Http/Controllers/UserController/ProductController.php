<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;
// OR
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\URL;

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
        // dd($id);
        $product = ProductModel::join('categories','products.category_id','=','categories.id')->select('products.*','categories.name as category_name','categories.slug as category_slug')->where('products.slug',$id)->firstOrFail();
        $category = CategoryModel::find($product->category_id);

        // dd($category->categories);
        $listCategory = array();
        foreach($category->categories as $child){
            array_push($listCategory,$child->id);
        }
        array_push($listCategory,$category->id);
        $parent = null;
        if($category->parent != null){
            $parent = CategoryModel::find($category->parent);
        }

        $relateds = ProductModel::whereIn('category_id',$listCategory)->take(16)->get();

        $listkeyword = CategoryModel::all();

        // dd($listkeyword->pluck('name')->toArray());

        SEOMeta::setTitle($product->name,false);
        SEOMeta::setDescription($product->short_description);
        SEOMeta::addMeta('article:published_time', $product->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('article:section', 'Nội thất văn phòng', 'property');
        SEOMeta::addKeyword($listkeyword->pluck('name')->toArray());

        OpenGraph::setDescription($product->short_description);
        OpenGraph::setTitle($product->title,false);
        OpenGraph::setUrl(URL::current());
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'vi_VN');
        OpenGraph::addProperty('locale:alternate', ['vi_VN', 'en-us']);

        OpenGraph::addImage($product->avatar);
        // OpenGraph::addImage($post->images->list('url'));
        OpenGraph::addImage(['url' => $product->avatar, 'size' => 300]);
        OpenGraph::addImage($product->avatar, ['height' => 300, 'width' => 300]);

        JsonLd::setTitle($product->title);
        JsonLd::setDescription($product->short_description);
        JsonLd::setType('Article');
        // JsonLd::addImage($product->images);
        return view('user.product_detail',compact('product','relateds','parent'));
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
