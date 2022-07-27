<?php

namespace App\Exports;

use App\Models\Lead;
use App\Models\LeadDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class LeadStatusDownload implements FromCollection,WithHeadings,WithMapping,WithEvents
{
    private $i = 1;
    private $id;
    private $type;

    public function __construct($id,$type)
    {
          $this->id = $id;
          $this->type = $type;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        if($this->type == 'duplicate')
        {
            $temp = LeadDetail::where('lead_id',decrypt($this->id))->where('is_duplicate',1)->get();
        }
        else
        {
            $temp = LeadDetail::where('lead_id',decrypt($this->id))->get();
        }

        return $temp;
    }

    public function headings(): array
    {
        return ['Sr.No','Lead Type','FirstName','LastName','Gender','Email','Address','City','State','Country','Phone Number','BirthDate','Age','Zip','Is Duplicate','Is Invalid'];
    }

    public function map($temp): array
    {
        $leadType = Lead::with('lead_type')->where('id',$temp->lead_id)->first()->lead_type->name;

        return [$this->i++,
            isset($temp->lead_id) ?  $leadType : '',
            $temp->first_name,
            $temp->last_name,
            $temp->gender == 1 ? 'Male' : 'Female',
            $temp->email,
            $temp->address,
            isset($temp->city)?$temp->city->name : '',
            isset($temp->state)?$temp->state->name : '',
            isset($temp->country) ? $temp->country->name : '',
            $temp->phone_number,
            $temp->birth_date,
            $temp->age,
            $temp->zip,
            $temp->is_duplicate == 1 ? 'Record Having Duplicate Email' : '' ,
            $temp->is_invalid == 1 ? 'Invalid Record , Email not specified' : ''
        ];
    }

    public function registerEvents(): array
    {

        return [
            AfterSheet::class => function(AfterSheet  $event){

                $columns =  [
                    'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I','J','K','L','M','N','O','P'
                ];

                $sheet = $event->sheet;

                foreach($columns as $column){
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }

                $cellRange = 'A1:P1';

                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(25);

                $sheet->getDelegate()->getStyle($cellRange)
                                ->getFont()
                                ->setBold(true);

                $sheet->getDelegate()->getStyle($cellRange)
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            }];
    }

}
