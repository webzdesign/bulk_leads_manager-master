<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithLimit;

class GetData implements ToCollection, WithLimit
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {

    }

    public function limit(): int
    {
        return 16; // only take 100 rows
    }
}
