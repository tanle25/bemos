<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use App\Models\ProductModel;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        $arg = ([
            "images/thumbs/0003765_ntvp-tu-tai-lieu_800.jpeg",
            "images/thumbs/0003766_ntvp-ban-giam-doc-go_800.jpeg",
            "images/thumbs/0003773_ban-truong-phong_450.jpeg",
            "images/thumbs/0003774_ban-module-nhan-vien_450.jpeg",
            "images/thumbs/0003775_ban-hop_450.jpeg",
            "images/thumbs/0003776_tu-nhan-vien_450.jpeg",
            "images/thumbs/0003777_ghe-giam-doc_450.jpeg",
            "images/thumbs/0003854_ban-nhan-vien-bmn-10032_415.png",
            "images/thumbs/0003854_ban-nhan-vien-bmn-10032_1200.png",
            "images/thumbs/0003854_ban-nhan-vien-bmn-10032.png",
            "images/thumbs/0003855_ban-nhan-vien-bmn-10031_80.png",
            "images/thumbs/0003855_ban-nhan-vien-bmn-10031_415.png",
            "images/thumbs/0003855_ban-nhan-vien-bmn-10031_1200.png",
            "images/thumbs/0003855_ban-nhan-vien-bmn-10031.png",
            "images/thumbs/0003857_ban-nhan-vien-bmn-10029_415.png",
            "images/thumbs/0003857_ban-nhan-vien-bmn-10029_1200.png",
            "images/thumbs/0003857_ban-nhan-vien-bmn-10029.png",
            "images/thumbs/0003879_tu-truong-phong-bmtl-t-10018_80.jpeg",
            "images/thumbs/0003879_tu-truong-phong-bmtl-t-10018_100.jpeg",
            "images/thumbs/0003879_tu-truong-phong-bmtl-t-10018_415.jpeg",
            "images/thumbs/0003879_tu-truong-phong-bmtl-t-10018_1200.jpeg",
            "images/thumbs/0003879_tu-truong-phong-bmtl-t-10018.jpeg",
            "images/thumbs/0003982_ban-giam-doc-bmg-10032_100.png",
            "images/thumbs/0004014_tu-giam-doc_450.jpeg",
            "images/thumbs/0003982_ban-giam-doc-bmg-10032.png",
            "images/thumbs/0004113_ke-tai-lieu-bmktl-10011_415.png",
            "images/thumbs/0004013_tu-truong-phong_450.jpeg",
            "images/thumbs/0004113_ke-tai-lieu-bmktl-10011.png",
            "images/thumbs/0004113_ke-tai-lieu-bmktl-10011_80.png",
            "images/thumbs/0004114_ke-tai-lieu-bmktl-10012_163.png",
            "images/thumbs/0004113_ke-tai-lieu-bmktl-10011_1200.png",
            "images/thumbs/0004114_ke-tai-lieu-bmktl-10012_80.png",
            "images/thumbs/0004114_ke-tai-lieu-bmktl-10012_415.png",
            "images/thumbs/0004114_ke-tai-lieu-bmktl-10012_1200.png",
            "images/thumbs/0004114_ke-tai-lieu-bmktl-10012.png",
            "images/thumbs/0004115_ke-tai-lieu-bmktl-10013_80.png",
            "images/thumbs/0004115_ke-tai-lieu-bmktl-10013_88.png",
            "images/thumbs/0004115_ke-tai-lieu-bmktl-10013_163.png",
            "images/thumbs/0004115_ke-tai-lieu-bmktl-10013_415.png",
            "images/thumbs/0004115_ke-tai-lieu-bmktl-10013_1200.png",
            "images/thumbs/0004115_ke-tai-lieu-bmktl-10013.png",
            "images/thumbs/0004116_ke-tai-lieu-bmktl-10014_80.png",
            "images/thumbs/0004116_ke-tai-lieu-bmktl-10014_163.png",
            "images/thumbs/0004116_ke-tai-lieu-bmktl-10014_415.png",
            "images/thumbs/0004116_ke-tai-lieu-bmktl-10014_1200.png",
            "images/thumbs/0004116_ke-tai-lieu-bmktl-10014.png",
            "images/thumbs/0004117_ke-tai-lieu-bmktl-10015_80.png",
            "images/thumbs/0004117_ke-tai-lieu-bmktl-10015_163.png",
            "images/thumbs/0004117_ke-tai-lieu-bmktl-10015_415.png",
            "images/thumbs/0004117_ke-tai-lieu-bmktl-10015_1200.png",
            "images/thumbs/0004117_ke-tai-lieu-bmktl-10015.png",
            "images/thumbs/0004118_ke-tai-lieu-bmktl-10016_415.png",
            "images/thumbs/0004118_ke-tai-lieu-bmktl-10016_1200.png",
            "images/thumbs/0004118_ke-tai-lieu-bmktl-10016.png",
            "images/thumbs/0004119_ke-tai-lieu-bmktl-10018_80.png",
            "images/thumbs/0004119_ke-tai-lieu-bmktl-10018_163.png",
            "images/thumbs/0004119_ke-tai-lieu-bmktl-10018_415.png",
            "images/thumbs/0004119_ke-tai-lieu-bmktl-10018_1200.png",
            "images/thumbs/0004119_ke-tai-lieu-bmktl-10018.png",
            "images/thumbs/0004120_ke-tai-lieu-bmktl-10019_163.png",
            "images/thumbs/0004120_ke-tai-lieu-bmktl-10019_415.png",
            "images/thumbs/0004120_ke-tai-lieu-bmktl-10019_1200.png",
            "images/thumbs/0004120_ke-tai-lieu-bmktl-10019.png",
            "images/thumbs/0004143_ke-tai-lieu-bmktl-10020_80.png",
            "images/thumbs/0004143_ke-tai-lieu-bmktl-10020_415.png",
            "images/thumbs/0004143_ke-tai-lieu-bmktl-10020_1200.png",
            "images/thumbs/0004143_ke-tai-lieu-bmktl-10020.png",
            "images/thumbs/0004144_ke-tai-lieu-bmktl-10021_80.png",
            "images/thumbs/0004144_ke-tai-lieu-bmktl-10021_415.png",
            "images/thumbs/0004144_ke-tai-lieu-bmktl-10021_1200.png",
            "images/thumbs/0004144_ke-tai-lieu-bmktl-10021.png",
            "images/thumbs/0004197_ban-hop-bmh-10011_100.png",
            "images/thumbs/0004197_ban-hop-bmh-10011_415.png",
            "images/thumbs/0004197_ban-hop-bmh-10011_1200.png",
            "images/thumbs/0004197_ban-hop-bmh-10011.png",
            "images/thumbs/0004198_ban-hop-bmh-10011_100.png",
            "images/thumbs/0004198_ban-hop-bmh-10011.png",
            "images/thumbs/0004199_ban-hop-bmh-10011_100.png",
            "images/thumbs/0004199_ban-hop-bmh-10011.png",
            "images/thumbs/0004200_ban-hop-bmh-10012_100.png",
            "images/thumbs/0004200_ban-hop-bmh-10012_415.png",
            "images/thumbs/0004200_ban-hop-bmh-10012_1200.png",
            "images/thumbs/0004200_ban-hop-bmh-10012.png",
            "images/thumbs/0004201_ban-hop-bmh-10012_100.png",
            "images/thumbs/0004201_ban-hop-bmh-10012.png",
            "images/thumbs/0004202_ban-hop-bmh-10012_100.png",
            "images/thumbs/0004202_ban-hop-bmh-10012.png",
            "images/thumbs/0004203_ban-hop-bmh-10012_100.png",
            "images/thumbs/0004203_ban-hop-bmh-10012.png",
            "images/thumbs/0004204_ban-hop-bmh-10013_100.png",
            "images/thumbs/0004204_ban-hop-bmh-10013_415.png",
            "images/thumbs/0004204_ban-hop-bmh-10013_1200.png",
            "images/thumbs/0004204_ban-hop-bmh-10013.png",
            "images/thumbs/0004205_ban-hop-bmh-10013_100.png",
            "images/thumbs/0004205_ban-hop-bmh-10013.png",
            "images/thumbs/0004206_ban-hop-bmh-10013_100.png",
            "images/thumbs/0004206_ban-hop-bmh-10013.png",
            "images/thumbs/0004207_ban-hop-bmh-10013_100.jpeg",
            "images/thumbs/0004207_ban-hop-bmh-10013.jpeg",
            "images/thumbs/0004208_ban-hop-bmh-10014_80.png",
            "images/thumbs/0004208_ban-hop-bmh-10014_88.png",
            "images/thumbs/0004208_ban-hop-bmh-10014_100.png",
            "images/thumbs/0004208_ban-hop-bmh-10014_415.png",
            "images/thumbs/0004208_ban-hop-bmh-10014_1200.png",
            "images/thumbs/0004208_ban-hop-bmh-10014.png",
            "images/thumbs/0004209_ban-hop-bmh-10014_100.png",
            "images/thumbs/0004209_ban-hop-bmh-10014.png",
            "images/thumbs/0004210_ban-hop-bmh-10014_100.png",
            "images/thumbs/0004210_ban-hop-bmh-10014.png",
            "images/thumbs/0004211_ban-hop-bmh-10015_80.png",
            "images/thumbs/0004211_ban-hop-bmh-10015_88.png",
            "images/thumbs/0004211_ban-hop-bmh-10015_100.png",
            "images/thumbs/0004211_ban-hop-bmh-10015_415.png",
            "images/thumbs/0004211_ban-hop-bmh-10015_1200.png",
            "images/thumbs/0004211_ban-hop-bmh-10015.png",
            "images/thumbs/0004212_ban-hop-bmh-10015_100.png",
            "images/thumbs/0004212_ban-hop-bmh-10015.png",
            "images/thumbs/0004213_ban-hop-bmh-10015_100.png",
            "images/thumbs/0004213_ban-hop-bmh-10015.png",
            "images/thumbs/0004214_ban-hop-bmh-10016_80.png",
            "images/thumbs/0004214_ban-hop-bmh-10016_100.png",
            "images/thumbs/0004214_ban-hop-bmh-10016_415.png",
            "images/thumbs/0004214_ban-hop-bmh-10016_1200.png",
            "images/thumbs/0004214_ban-hop-bmh-10016.png",
            "images/thumbs/0004215_ban-hop-bmh-10016_100.png",
            "images/thumbs/0004215_ban-hop-bmh-10016.png",
            "images/thumbs/0004216_ban-hop-bmh-10016_100.png",
            "images/thumbs/0004216_ban-hop-bmh-10016.png",
            "images/thumbs/0004217_ban-hop-bmh-10018_80.png",
            "images/thumbs/0004217_ban-hop-bmh-10018_100.png",
            "images/thumbs/0004217_ban-hop-bmh-10018_415.png",
            "images/thumbs/0004217_ban-hop-bmh-10018_1200.png",
            "images/thumbs/0004217_ban-hop-bmh-10018.png",
            "images/thumbs/0004218_ban-hop-bmh-10018_100.png",
            "images/thumbs/0004218_ban-hop-bmh-10018.png",
            "images/thumbs/0004219_ban-hop-bmh-10018_100.png",
            "images/thumbs/0004219_ban-hop-bmh-10018.png",
            "images/thumbs/0004220_ban-hop-bmh-10019_80.png",
            "images/thumbs/0004220_ban-hop-bmh-10019_100.png",
            "images/thumbs/0004220_ban-hop-bmh-10019_415.png",
            "images/thumbs/0004220_ban-hop-bmh-10019_1200.png",
            "images/thumbs/0004220_ban-hop-bmh-10019.png",
            "images/thumbs/0004221_ban-hop-bmh-10019_100.png",
            "images/thumbs/0004221_ban-hop-bmh-10019.png",
            "images/thumbs/0004222_ban-hop-bmh-10019_100.png",
            "images/thumbs/0004222_ban-hop-bmh-10019.png",
            "images/thumbs/0004232_ban-hop-bmh-10020_100.png",
            "images/thumbs/0004232_ban-hop-bmh-10020_415.png",
            "images/thumbs/0004232_ban-hop-bmh-10020_1200.png",
            "images/thumbs/0004232_ban-hop-bmh-10020.png",
            "images/thumbs/0004233_ban-hop-bmh-10020_100.png",
            "images/thumbs/0004233_ban-hop-bmh-10020.png",
            "images/thumbs/0004234_ban-hop-bmh-10020_100.png",
            "images/thumbs/0004234_ban-hop-bmh-10020.png",
            "images/thumbs/0004235_ban-hop-bmh-10022_88.png",
            "images/thumbs/0004235_ban-hop-bmh-10022_100.png",
            "images/thumbs/0004235_ban-hop-bmh-10022_415.png",
            "images/thumbs/0004235_ban-hop-bmh-10022_1200.png",
            "images/thumbs/0004235_ban-hop-bmh-10022.png",
            "images/thumbs/0004236_ban-hop-bmh-10022_100.png",
            "images/thumbs/0004236_ban-hop-bmh-10022.png",
            "images/thumbs/0004237_ban-hop-bmh-10022_100.png",
            "images/thumbs/0004237_ban-hop-bmh-10022.png",
            "images/thumbs/0004238_ban-hop-bmh-10023_80.png",
            "images/thumbs/0004238_ban-hop-bmh-10023_88.png",
            "images/thumbs/0004238_ban-hop-bmh-10023_100.png",
            "images/thumbs/0004238_ban-hop-bmh-10023_415.png",
            "images/thumbs/0004238_ban-hop-bmh-10023_1200.png",
            "images/thumbs/0004238_ban-hop-bmh-10023.png",
            "images/thumbs/0004239_ban-hop-bmh-10023_100.png",
            "images/thumbs/0004239_ban-hop-bmh-10023.png",
            "images/thumbs/0004240_ban-hop-bmh-10023_100.png",
            "images/thumbs/0004240_ban-hop-bmh-10023.png",
            "images/thumbs/0004241_ban-hop-bmh-10025_80.png",
            "images/thumbs/0004241_ban-hop-bmh-10025_100.png",
            "images/thumbs/0004241_ban-hop-bmh-10025_415.png",
            "images/thumbs/0004241_ban-hop-bmh-10025_1200.png",
            "images/thumbs/0004241_ban-hop-bmh-10025.png",
            "images/thumbs/0004242_ban-hop-bmh-10025_100.png",
            "images/thumbs/0004242_ban-hop-bmh-10025.png",
            "images/thumbs/0004243_ban-hop-bmh-10025_100.png",
            "images/thumbs/0004243_ban-hop-bmh-10025.png",
            "images/thumbs/0004245_ban-hop-bmh-10026_80.png",
            "images/thumbs/0004245_ban-hop-bmh-10026_100.png",
            "images/thumbs/0004245_ban-hop-bmh-10026_415.png",
            "images/thumbs/0004245_ban-hop-bmh-10026_1200.png",
            "images/thumbs/0004245_ban-hop-bmh-10026.png",
            "images/thumbs/0004246_ban-hop-bmh-10026_100.png",
            "images/thumbs/0004246_ban-hop-bmh-10026.png",
            "images/thumbs/0004247_ban-hop-bmh-10026_100.png",
            "images/thumbs/0004247_ban-hop-bmh-10026.png",
            "images/thumbs/0004248_ban-hop-bmh-10028_80.png",
            "images/thumbs/0004248_ban-hop-bmh-10028_100.png",
            "images/thumbs/0004248_ban-hop-bmh-10028_415.png",
            "images/thumbs/0004248_ban-hop-bmh-10028_1200.png",
        ]);
        $name = ([
            'BÀN GIÁM ĐỐC BMG-10040',
            'BÀN GIÁM ĐỐC BMG-10050',
            'BÀN GIÁM ĐỐC BMG-10070',
            'BÀN GIÁM ĐỐC BMG-10010',
            'BÀN GIÁM ĐỐC BMG-10040',
            'BÀN TRƯỞNG PHÒNG BMT-10020',
            'BÀN TRƯỞNG PHÒNG BMT-10030',
            'BÀN TRƯỞNG PHÒNG BMT-10040',
            'BÀN TRƯỞNG PHÒNG BMT-10050',
            'BÀN TRƯỞNG PHÒNG BMT-10070',
            'BÀN HỌP BMH-10022',
            'BÀN HỌP BMH-10042',
            'BÀN HỌP BMH-10062',
            'BÀN HỌP BMH-10082',
            'BÀN HỌP BMH-12022',
            'BÀN HỌP BMH-10322',
            'BÀN HỌP BMH-10422',
            'BÀN HỌP BMH-10622',
            'TỦ GIÁM ĐỐC BMTL-G-10013',
            'TỦ GIÁM ĐỐC BMTL-G-10014',
            'TỦ GIÁM ĐỐC BMTL-G-1003',
        ]);
        // dd($arg[3]);
        for($i =0; $i<194; $i++){
            $rand = rand(0,20);
            $images = array();
            for($j = 0; $j<rand(3,7);$j++){
                array_push($images,$arg[rand(0,194)]);
            }
            // dd($name[3]);
            ProductModel::create([
                'category_id'=>rand(1,18),
                'name' =>$name[$rand],
                'sku'=>Str::random(8),
                'slug'=>Str::slug($name[$rand]).Str::random(8),
                'price'=>rand(1000,10000)*1000,
                'avatar'=>$arg[$i],
                'images'=>json_encode($images),
                'short_description' =>'Tủ tài liệu (Tủ hồ sơ) giám đốc là thiết bị nội thất không thể thiếu trong mỗi văn phòng làm việc của các tổ chức, công ty. Tủ tài liệu ngày nay không chỉ đơn thuần là thiết bị văn phòng để cất trữ tài liệu, hồ sơ, sổ sách, giấy tờ mà còn là một vật dụng trang trí thể hiện diện mạo, sự chuyên nghiệp, tính thẩm mỹ và đẳng cấp của văn phòng.',
                'description' =>'Tủ tài liệu (Tủ hồ sơ) giám đốc là thiết bị nội thất không thể thiếu trong mỗi văn phòng làm việc của các tổ chức, công ty. Tủ tài liệu ngày nay không chỉ đơn thuần là thiết bị văn phòng để cất trữ tài liệu, hồ sơ, sổ sách, giấy tờ mà còn là một vật dụng trang trí thể hiện diện mạo, sự chuyên nghiệp, tính thẩm mỹ và đẳng cấp của văn phòng.',
            ]);
        }

    }
}