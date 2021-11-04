<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['guard_name' => 'admin','name' => 'Thêm người dùng']);
        Permission::create(['guard_name' => 'admin','name' => 'Thay đổi thông tin người dùng']);
        Permission::create(['guard_name' => 'admin','name' => 'Xoá người dùng']);

        Permission::create(['guard_name' => 'admin','name' => 'Thêm sản phẩm']);
        Permission::create(['guard_name' => 'admin','name' => 'Thay đổi thông tin sản phẩm']);
        Permission::create(['guard_name' => 'admin','name' => 'Xoá sản phẩm']);

        Permission::create(['guard_name' => 'admin','name' => 'Thêm bài viết']);
        Permission::create(['guard_name' => 'admin','name' => 'Thay đổi thông tin bài viết']);
        Permission::create(['guard_name' => 'admin','name' => 'Xoá bài viết']);

        Permission::create(['guard_name' => 'admin','name' => 'Thay đổi thông tin website']);



        Permission::create(['guard_name' => 'shop','name' => 'shop manager']);
        Permission::create(['guard_name' => 'shop','name' => 'create product']);

        // $role1 = Role::create(['name' => 'writer']);
        // $role1->givePermissionTo('edit articles');
        // $role1->givePermissionTo('delete articles');

        $role2 = Role::create(['guard_name' => 'admin','name' => 'supper admin']);
        $role2->givePermissionTo('Thêm người dùng');
        $role2->givePermissionTo('Thay đổi thông tin người dùng');
        $role2->givePermissionTo('Xoá người dùng');

        $role2->givePermissionTo('Thêm sản phẩm');
        $role2->givePermissionTo('Thay đổi thông tin sản phẩm');
        $role2->givePermissionTo('Xoá sản phẩm');

        $role2->givePermissionTo('Thêm bài viết');
        $role2->givePermissionTo('Thay đổi thông tin bài viết');
        $role2->givePermissionTo('Xoá bài viết');

        $role2->givePermissionTo('Thay đổi thông tin website');

        // $shop = Role::create(['guard_name' => 'shop','name' => 'shop']);
        // $shop->givePermissionTo('shop manager');
        // $shop->givePermissionTo('create product');

    }
}
