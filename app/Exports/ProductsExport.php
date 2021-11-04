<?php

namespace App\Exports;

use App\Models\ProductModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProductModel::all();
    }
    public function headings() :array {
    	return ["id", "tiêu đề", "mô tả", "tình trạng", "giá", "còn hàng", "liên kết hình ảnh", "gtin", "mpn", "nhãn hiệu", "danh mục sản phẩm của Google"];
    }
    public function map($product): array {
        return [
            $product->sku,
            $product->name,
            $product->short_description,
            'mới',
            $product->price. ' vnd',
            ' còn hàng',
            $product->avatar,
            '',
            '',
            '',
            ''
        ];
    }

}
