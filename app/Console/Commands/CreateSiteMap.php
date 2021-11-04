<?php

namespace App\Console\Commands;


// use DB;
// use Carbon\Carbon;

use App\Models\CategoryModel;
use App\Models\PageModel;
use App\Models\PostModel;
use App\Models\ProductModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class CreateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $sitemap = App::make("sitemap");
        $sitemap->add(URL::to('/'), Carbon::now(), '1.0', 'daily');
        $categories = CategoryModel::all();
        foreach($categories as $category){
            $sitemap->add(route('categorymenu.show',$category->slug),$category->created_at,1,'daily');
        }
        $pages = PageModel::all();
        foreach($pages as $page){
            $sitemap->add(route('pages.show',$page->slug),$page->created_at,0.8,'daily');
        }
        $posts = PostModel::all();
        foreach($posts as $post){
            $sitemap->add(route('user.postDetail',$post->slug),$post->created_at,0.8,'daily');
        }
        $products = ProductModel::all();
        foreach($products as $product){
            $sitemap->add(route('detail.show',$product->slug),$product->created_at,1,'daily');
        }
        $sitemap->store('xml', 'sitemap');
    }
}
