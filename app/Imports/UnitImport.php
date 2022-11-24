<?php

namespace App\Imports;

use App\Models\Unit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Hash;

class UnitImport implements ToCollection
{
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) 
        { 
            Unit::create([
                'name' => $row[0],
                'address' => $row[1],
                'category' => $row[2]
            ]);

        }

    }
}
