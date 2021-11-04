<?php

namespace Database\Seeders;

use App\Models\CategoryModel;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        CategoryModel::create([
            'name'=>'Bàn văn phòng',
            'slug'=>'ban-van-phong',
            'banner'=>"images/thumbs/0004246_ban-hop-bmh-10026_100.png",

        ]);
        CategoryModel::create([
            'name'=>'Bàn giám đốc',
            'slug'=>'ban-giam-doc',
            'banner'=>"images/thumbs/0004246_ban-hop-bmh-10026_100.png",

        ]);
        CategoryModel::create([
            'name'=>'Bàn trưởng phòng',
            'slug'=>'ban-truong-phong',
            'banner'=>"images/thumbs/0004246_ban-hop-bmh-10026_100.png",

        ]);
        CategoryModel::create([
            'name'=>'Bàn Nhân viên',
            'slug'=>'ban-nhan-vien',
            'banner'=>"images/thumbs/0004246_ban-hop-bmh-10026_100.png",

        ]);
        CategoryModel::create([
            'name'=>'Bàn module nhân viên',
            'slug'=>'ban-module-nhan-vien',
            'banner'=>"images/thumbs/0004246_ban-hop-bmh-10026_100.png",

        ]);
        CategoryModel::create([
            'name'=>'Bàn họp',
            'slug'=>'ban-hop',
            'banner'=>"images/thumbs/0004246_ban-hop-bmh-10011_100.png",

        ]);
        CategoryModel::create([
            'name'=>'Tủ văn phòng',
            'slug'=>'tu-van-phong',
            'banner'=>"images/thumbs/0004246_ban-hop-bmh-10011_100.png",

        ]);
        CategoryModel::create([
            'name'=>'Tủ giám đốc',
            'slug'=>'tu-giam-doc',
            'banner'=>"images/thumbs/0004246_ban-hop-bmh-10012_100.png",

        ]);
        CategoryModel::create([
            'name'=>'Tủ trưởng phòng',
            'slug'=>'tu-truong-phong',
            'banner'=>"images/thumbs/0004246_ban-hop-bmh-10013_100.png",

        ]);
        CategoryModel::create([
            'name'=>'Tủ nhân viên',
            'slug'=>'tu-nhan-vien',
            'banner'=>"images/thumbs/0004246_ban-hop-bmh-10014_100.png",

        ]);
        CategoryModel::create([
            'name'=>'Tủ di động',
            'slug'=>'tu-di-dong',
            'banner'=>"images/thumbs/0004246_ban-hop-bmh-10015_100.png",

        ]);
        CategoryModel::create([
            'name'=>'Tủ locker',
            'slug'=>'tu-locker',
            'banner'=>"images/thumbs/0004246_ban-hop-bmh-10016_100.png",

        ]);
        CategoryModel::create([
            'name'=>'Kệ văn phòng',
            'slug'=>'ke-van-phong',
            'banner'=>"images/thumbs/0004246_ban-hop-bmh-10017_100.png",

        ]);
        CategoryModel::create([
            'name'=>'Kệ giám đốc',
            'slug'=>'ke-giam-doc',
            'banner'=>"images/thumbs/0004246_ban-hop-bmh-10018_100.png",

        ]);
        CategoryModel::create([
            'name'=>'Kệ trưởng phòng',
            'slug'=>'ke-truong-phong',
            'banner'=>"images/thumbs/0004246_ban-hop-bmh-10019_100.png",

        ]);
        CategoryModel::create([
            'name'=>'Kệ tài liệu',
            'slug'=>'ke-tai-lieu',
            'banner'=>"images/thumbs/0004246_ban-hop-bmh-10020_100.png",

        ]);
        CategoryModel::create([
            'name'=>'Ghế',
            'slug'=>'ghe',
            'banner'=>"images/thumbs/0004246_ban-hop-bmh-10021_100.png",

        ]);
        CategoryModel::create([
            'name'=>'Ghế văn phòng the city',
            'slug'=>'ghe-van-phong-the-city',
            'banner'=>"images/thumbs/0004246_ban-hop-bmh-10022_100.png",

        ]);
        CategoryModel::create([
            'name'=>'Ghế văn phòng the mia',
            'slug'=>'ghe-van-phong-the-mia',
            'banner'=>"images/thumbs/0004239_ban-hop-bmh-10023_100.png",

        ]);
        CategoryModel::create([
            'name'=>'Dự án',
            'slug'=>'du-an',
            'banner'=>"images/thumbs/0004241_ban-hop-bmh-10025_1200.png",

        ]);
        CategoryModel::create([
            'name'=>'Nội thất trường học',
            'slug'=>'noi-that-truong-hoc',
            'banner'=>"images/thumbs/0004245_ban-hop-bmh-10026_415.png",


        ]);
        CategoryModel::create([
            'name'=>'Nội thất gia đình',
            'slug'=>'noi-that-gia-dinh',
            'banner'=>"images/thumbs/0004246_ban-hop-bmh-10026_100.png",

        ]);
        CategoryModel::create([
            'name'=>'Nội thất bệnh viện',
            'slug'=>'noi-that-benh-vien',
            'banner'=>"images/thumbs/0004241_ban-hop-bmh-10025_100.png",

        ]);
    }
}
