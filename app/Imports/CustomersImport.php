<?php

namespace App\Imports;

use App\Models\Customer;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CustomersImport implements ToModel, WithStartRow, WithProgressBar
{
    use Importable;
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $tmp = explode(',', $row[4], 2);
        $date = Carbon::createFromFormat('F j,Y', $tmp[1])->format('Y-m-d');

        return new Customer([
            'job_title' => $row[1],
            'email' => $row[2],
            'name'  => $row[3],
            'registered_since' => $date,
            'phone' => $row[5]
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
