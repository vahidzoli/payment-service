<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductsImport implements ToModel, WithStartRow, WithProgressBar
{
    use Importable;
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name'     => $row[1],
            'price'    => $row[2]
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
