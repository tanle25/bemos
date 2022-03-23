<?php

namespace App\Http\Controllers;

use App\Models\BannerModel;
use App\Models\CategoryModel;
use App\Models\CustommerContactModel;
use App\Models\District;
use App\Models\PageModel;
use App\Models\PostModel;
use App\Models\ProductModel;
use App\Models\StreetModel;
use App\Models\Ward;
use App\Models\Webinfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;
// OR
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    public function index()
    {



        $option = json_decode(Webinfo::all()->first()->section);
        $parentCategory = CategoryModel::whereNull('parent')->get();
        $categories = [];
        if($option !=null){
            $categories = CategoryModel::orderByField('id',$option)->whereIn('id',$option)->get();
        }

        $colections = array();
        foreach($categories as $category){
            $listID = array();
            foreach($category->categories as $child){
                // dd($child->id);
                $listID[] = $child->id;
            }
            $listID[] =$category->id;
            $products = ProductModel::whereIn('category_id',$listID)->whereStatus(1)->orderBy('created_at','desc')->take(6)->get();
            // dd($products);
            $colections[$category->name]= $products;
        }
        $banners = BannerModel::orderBy('position','asc')->get();
        $related_products = ProductModel::whereFeatured(1)->whereStatus(1)->get();
        $allCategories = CategoryModel::all();


        // create meta key

        SEOTools::setTitle('Trang chủ','Công ty nội thất Anh Phát');
        SEOTools::setDescription('Công ty nội thất Anh Phát, bàn ghế học sinh, bàn ghế văn phòng, bàn ghế hội trường');
        SEOTools::opengraph()->setUrl(URL::to('/'));
        SEOTools::setCanonical(URL::to('/'));
        SEOTools::opengraph()->addProperty('type', 'website');
        // SEOTools::twitter()->setSite('@LuizVinicius73');
        SEOTools::jsonLd()->addImage(Webinfo::all()->first()->logo);



        return view('user.home',compact('categories','banners','colections','related_products','allCategories','parentCategory'));
    }


    public function category($slug)
    {
        # code...
        // dd($slug);
        $categories =CategoryModel::whereSlug($slug)->whereStatus(1)->first()->categories;
        $category = CategoryModel::whereSlug($slug)->whereStatus(1)->first();
        $category_colection = array();
        $listkeyword = CategoryModel::all()->pluck('name')->toArray();
        $keyword = array();
        foreach($categories as $colection){
            array_push($category_colection,$colection->id);
        }
        array_push($category_colection,$category->id);

        $products = ProductModel::whereIn('category_id',$category_colection)->whereStatus(1)->orderBy('created_at','desc')->paginate(12);
        // dd($products);
        $category_name = $category->name;
        SEOMeta::setTitle($category_name,false);
        SEOMeta::setDescription($category->description);
        SEOMeta::addMeta('article:published_time', $category->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('article:section', $category->name, 'property');
        SEOMeta::addKeyword($listkeyword);

        OpenGraph::setDescription($category->description);
        OpenGraph::setTitle($category->name,false);
        OpenGraph::setUrl(URL::current());
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'vi_VN');
        OpenGraph::addProperty('locale:alternate', ['vi_VN', 'en-us']);

        OpenGraph::addImage($category->image);
        // OpenGraph::addImage($category->image->list('url'));
        OpenGraph::addImage(['url' => $category->image, 'size' => 300]);
        OpenGraph::addImage($category->image, ['height' => 300, 'width' => 300]);

        JsonLd::setTitle($category->name);
        JsonLd::setDescription($category->description);
        JsonLd::setType('Category');
        // JsonLd::addImage($category->image->list('url'));
        if($categories->first() != null){
        // dd($category);
            $category_description = $category->description;
            $featureds = ProductModel::whereFeatured(1)->orderBy('updated_at','desc')->whereStatus(1)->take(8)->get();
            return view('user.parent_category',compact('categories','category','featureds','category_description'));
        }else{
            $parent = CategoryModel::find($category->parent);
            return view('user.category', compact('products','category','parent'));

        }
    }


    public function search($keyword)
    {
        # code...
        $products = ProductModel::where('name','like', "%$keyword%")->join('shops','products.shop_id','=','shops.id')->where('products.status',1)
        ->select('products.*','shops.shop_name','shops.shop_avatar','shops.id as shop_id')->get();
        return view('user.pages.search',compact('products'));
    }


    public function getDistricts($province_id)
    {
        # code...
        $districts = District::where('_province_id',$province_id)->get();

        return response()->json($districts);
    }
    public function getWards($district_id)
    {
        # code...
        $wards = Ward::where('_district_id',$district_id)->get();
        return response()->json($wards);
    }
    public function getStreet(Request $request)
    {
        # code...
        // $street = ;
        $keyword = $request->keyword;
        $street = StreetModel::select('_name')->where('_name','LIKE', "%$keyword%")
        ->where('_province_id',$request->provice_id)->where('_district_id',$request->district_id)->get();
        return response()->json($street);
    }
    public function showIntroduce()
    {
        # code...
        $page = PageModel::all()->first();
        return view('user.introduce',compact('page'));
    }

    public function getRecenly(Request $request)
    {
        # code...
        $recenly = ProductModel::find($request->data);
        return response()->json($recenly);
    }

    public function showContact()
    {
        # code...
        return view('user.contact');
    }

    public function contact(Request $request)
    {
        # code...
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'content'=>'required',
        ]);
        $contact = new CustommerContactModel();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->content = $request->content;
        $contact->save();
        return redirect()->back()->with(['success'=>'lien he thanh cong']);
    }

    public function listPost()
    {
        # code...
        $posts = PostModel::whereStatus(1)->get();
        // dd($posts);
        return view('user.post',compact('posts'));
    }
    public function postDetail($slug)
    {
        # code...

        $post = PostModel::whereSlug($slug)->whereStatus(1)->firstOrFail();
        $listkeyword = CategoryModel::all();

        SEOMeta::setTitle($post->title,false);
        SEOMeta::setDescription($post->description);
        SEOMeta::addMeta('article:published_time', $post->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('article:section', 'Nội thất văn phòng', 'property');
        SEOMeta::addKeyword($listkeyword->pluck('name')->toArray());

        OpenGraph::setDescription($post->description);
        OpenGraph::setTitle($post->title,false);
        OpenGraph::setUrl(URL::current());
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'vi_VN');
        OpenGraph::addProperty('locale:alternate', ['vi_VN', 'en-us']);

        OpenGraph::addImage($post->avatar);
        // OpenGraph::addImage($post->images->list('url'));
        OpenGraph::addImage(['url' => $post->avatar, 'size' => 300]);
        OpenGraph::addImage($post->avatar, ['height' => 300, 'width' => 300]);

        JsonLd::setTitle($post->title);
        JsonLd::setDescription($post->description);
        JsonLd::setType('Article');
        JsonLd::addImage($post->image);
        // dd($post->comments);
        return view('user.post_detail',compact('post'));

    }
    public function listProvices()
    {
        # code...
        $response = Http::get('https://partner.viettelpost.vn/v2/categories/listProvinceById?provinceId=-1');
        return response()->json($response->json()['data']);
    }
    public function listDistrictByProvince($id)
    {
        # code...
        $url = 'https://partner.viettelpost.vn/v2/categories/listDistrict?provinceId='.$id;
        $response = Http::get($url);
        return response()->json($response->json()['data']);
        // dd($response->body());
    }

    public function listWards($id)
    {
        # code...
        $url = 'https://partner.viettelpost.vn/v2/categories/listWards?districtId='.$id;
        $response = Http::get($url);
        return response()->json($response->json()['data']);
        // dd($response->body());
    }
    public function export()
    {
        # code...
        return Excel::download(new ProductsExport, 'product-'.time().'.tsv');
    }

    public function productExport()
    {
        # code...
        $products = ProductModel::all();
        // dd($products->category);
        return view('admin.pages.product.product_export',compact('products'));
    }
}
