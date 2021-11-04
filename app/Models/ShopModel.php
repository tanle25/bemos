<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class ShopModel extends Authenticatable
{
    use HasFactory,HasRoles;
    protected $table='shops';
    protected $fillable = [
        'email',
            'phone',
            'password',
            'shop_name',
            'shop_type',
            'ward',
            'address',
            'desription'=>'',
            'document_type',
            'document_number',
            'document_place',
            'document_dae',
            'shop_avatar',
            'shop_document_img1',
            'shop_document_img2',
    ];
}
