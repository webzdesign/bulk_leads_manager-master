<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\FromArray;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Lead;
use App\Models\LeadDetail;
use App\Models\AgeGroup;
use App\Models\State;


class LeadDetailsExport implements FromCollection,WithHeadings, WithEvents,ShouldAutoSize,WithHeadingRow
{
    /**
    * @return \Illuminate\Support\Collection
    */
   protected $lead_collection;

    function __construct($lead_collection) {
        $this->lead_collection = $lead_collection;
    }

    public function headings(): array
    {
        return ["First name", "Last name", "Gender", "Email", "Address", "Country", "State", "City", "Phone number", "Birth date", "Zip code", "IP", "Date Generated"];
    }

    public function collection()
    {
        return collect($this->lead_collection);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $lead_details_data) {

                $lead_details_data->sheet->getDelegate()->getColumnDimension('A')->setWidth(20);
                $lead_details_data->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
                $lead_details_data->sheet->getDelegate()->getColumnDimension('C')->setWidth(30);
                $lead_details_data->sheet->getDelegate()->getColumnDimension('D')->setWidth(30);
                $lead_details_data->sheet->getDelegate()->getColumnDimension('E')->setWidth(30);
                $lead_details_data->sheet->getDelegate()->getColumnDimension('F')->setWidth(30);
                $lead_details_data->sheet->getDelegate()->getColumnDimension('G')->setWidth(30);
                $lead_details_data->sheet->getDelegate()->getColumnDimension('H')->setWidth(30);
                $lead_details_data->sheet->getDelegate()->getColumnDimension('I')->setWidth(30);
                $lead_details_data->sheet->getDelegate()->getColumnDimension('J')->setWidth(30);
                $lead_details_data->sheet->getDelegate()->getColumnDimension('K')->setWidth(30);
                $lead_details_data->sheet->getDelegate()->getColumnDimension('L')->setWidth(30);

                $lead_details_data->sheet->getDelegate()->getStyle('A1:L1')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('DD4B39');
            },
        ];
    }

}
