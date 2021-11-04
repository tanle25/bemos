<?php

namespace Database\Seeders;

use App\Models\AdminModel;
use App\Models\ShopModel;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $user = User::create([
        //     'name' => 'tan le',
        //     'email' => 'tanlps@gmail.com',
        //     'phone' => '0973685031',
        //     'password' => Hash::make('Tanle@123'),
        // ]);
        $user = User::create([
            'gender'=>1,
            'first_name'=>'tan',
            'last_name'=>'le',
            'birthday'=>'25/01/1992',
            'company'=>'Ham rong media',
            'email' => 'tanlps@gmail.com',
            // 'phone'=>'0972685031',
            'password' => Hash::make('Tanle@123'),

        ]);

        $admin = AdminModel::create([
            'name'=>'admin',
            'email' => 'tanlps@gmail.com',
            'phone'=>'0972685031',
            'password' => Hash::make('Tanle@123'),

        ]);
        $admin->assignRole('supper admin');


    }
}
