<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BeyondCode\Vouchers\Traits\HasVouchers;
class ProductModel extends Model
{
    use HasFactory, HasVouchers;
    protected $table = 'products';
    protected $fillable = [
        'category_id',
        'name',
        'sku',
        'slug',
        'price',
        'avatar',
        'images',
        'short_description',
        'description'
    ];
    public function reviews()
    {
        return $this->hasMany(ProductRateModel::class, 'product_id', 'id');
    }
    public function parent() {
        return $this->belongsTo(CategoryModel::class,'category_id');
    }
    public function category()
    {
        # code...
        return $this->hasOne(CategoryModel::class,'id','category_id');
    }
    // public function products() {
    //     return $this->hasMany(ProductModel::class,'category_id');
    // }
}
