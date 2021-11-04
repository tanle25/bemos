<?php

namespace App\Providers;

use App\Models\CategoryModel;
use App\Models\MenuModel;
use App\Models\PageModel;
use Illuminate\Pagination\Paginator;
use App\Models\ProductTypeModel;
use App\Models\Webinfo;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $menuConfig = MenuModel::first();
        $theme = Webinfo::first();
        $megaMenu = CategoryModel::whereNull('parent')->get();
        $listCategory = $menuConfig->category ==null ? array(): json_decode($menuConfig->category);
        // dd($listCategory);
        $menus = null;
        $pages =null;
        if($listCategory !=null){
            $menus = CategoryModel::orderByField('id',$listCategory)->whereNull('parent')->find($listCategory);
        }
        if($menuConfig->page !=null){
            $pages = PageModel::orderByField('id',json_decode($menuConfig->page))->wherePosition(1)->whereParent(null)->find(json_decode($menuConfig->page));
        }
        view()->share(['menus'=>$menus,'theme'=>$theme,'pages'=>$pages,'megaMenu'=>$megaMenu]);
        Paginator::useBootstrap();

    }
}
