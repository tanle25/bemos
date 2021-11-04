<?php

namespace Database\Seeders;

use App\Models\ProvinceModel;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $countryJson = Storage::disk('local')->get(asset('viettel-province.json'));
        $data = json_decode($countryJson, true);
          foreach($data as $province){
            ProvinceModel::create([
                'PROVINCE_ID'=>$province['PROVINCE_ID'],
                'PROVINCE_CODE'=>$province['PROVINCE_CODE'],
                'PROVINCE_NAME'=>$province['PROVINCE_NAME'],

            ]);
          }
    }
}
