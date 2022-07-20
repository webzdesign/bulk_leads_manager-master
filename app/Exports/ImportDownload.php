<?php

namespace App\Exports;

use App\Models\LeadDetail;
use Maatwebsite\Excel\Concerns\FromCollection;

class ImportDownload implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return LeadDetail::all();
    }
}
