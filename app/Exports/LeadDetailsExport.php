<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\Lead;
use App\Models\LeadDetail;
use App\Models\OrderDetail;

class LeadDetailsExport implements FromCollection,WithHeadings, WithEvents,ShouldAutoSize
{

    protected $order_data;

    function __construct($order_data) {
        $this->order_data = $order_data;
    }

    public function headings(): array
    {
        return ["Name", "Email", "Address", "Mobile number"];
    }

    public function collection()
    {
        $lead_details_data = [];
        $order_data = $this->order_data;

        foreach($order_data as $key => $value){
            $lead_ids = Lead::where(['lead_type_id' => $value->lead_type_id,'age_group_id' => $value->age_group_id])->pluck('id')->toArray();

            if(isset($lead_ids) && $lead_ids !=null){
                $skip_lead_details_ids = OrderDetail::where(['order_id' => $value->id])->pluck('lead_details_id')->toArray();
                $lead_details = LeadDetail::whereIn('lead_id',$lead_ids)->take($value->qty);

                if(isset($skip_lead_details_ids) && $skip_lead_details_ids !=null){
                    $lead_details->whereNotIn('id',$skip_lead_details_ids);
                }
                $lead_details = $lead_details->get();
                // $lead_details_data[$value->client->email][] = $lead_details;
                $lead_details_data[] = $lead_details;
            }
        }
        return collect($lead_details_data);
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

                $lead_details_data->sheet->getDelegate()->getStyle('A1:I1')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('DD4B39');
            },
        ];
    }
}
