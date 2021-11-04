<?php

namespace App\Exports;

use App\Models\ProductModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromView
{


    public function view(): View
    {
        return view('admin.exports.product', [
            'products' => ProductModel::all()
        ]);
    }


}
