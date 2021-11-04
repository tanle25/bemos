<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageModel extends Model
{
    use HasFactory;
    protected $table='pages';
    protected $fillable=[
        'title','slug','content'
    ];
    public function childs()
    {
        return $this->hasMany(PageModel::class,'parent');
    }
    public function parent() {
        return $this->belongsTo(PageModel::class,'parent');
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
