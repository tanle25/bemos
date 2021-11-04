<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'banner',
    ];
    public function categories()
    {
        return $this->hasMany(CategoryModel::class,'parent');
    }

    public function products()
    {
        return $this->hasMany(ProductModel::class,'category_id');
    }

    public function parent() {
        return $this->belongsTo(CategoryModel::class,'parent');
    }

    public function scopeOrderByField($query, string $field, array $values)
    {
        if (empty($values)) {
            return $query;
        }

        $placeholders = implode(', ', array_fill(0, count($values), '?'));

        return $query->orderByRaw("FIELD({$field}, {$placeholders})", $values);
    }

}
