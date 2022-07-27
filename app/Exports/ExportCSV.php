<?php

namespace App\Exports;

use App\Models\City;
use App\Models\Country;
use App\Models\Lead;
use App\Models\LeadDetail;
use App\Models\State;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportCSV implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($id, $type)
    {
        $this->id = $id;
        $this->type = $type;
    }

    public function collection()
    {
        $lead = Lead::find($this->id);
        if($this->type == "duplicate") {
            $data = LeadDetail::where('lead_id',$lead->id)->where('is_duplicate',1)->get();
        } else {
            $data = LeadDetail::where('lead_id',$lead->id)->where('is_duplicate',0)->where('is_invalid',0)->get();
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            "FirstName",
            "LastName",
            "Email",
            "Phone Number",
            "Gender",
            "Address",
            "City",
            "State",
            "Country",
            "Birth Date",
            "Age",
            "Zip"
        ];
    }

    public function map($data): array
    {
        if($data->gender === null) {
            $gender = null;
        } else if ($data->gender == 1) {
            $gender = "Female";
        } else {
            $gender = "Male";
        }

        if($data->city_id != '') {
            $city = City::where('id',$data->city_id)->first()->name;
        } else {
            $city = null;
        }
        if($data->state_id != '') {
            $state = State::where('id',$data->state_id)->first()->name;
        } else {
            $state = null;
        }
        if($data->country_id) {
            $country = Country::where('id',$data->country_id)->first()->name;
        } else {
            $country = null;
        }

        return [
            "FirstName"    => $data->first_name,
            "LastName"     => $data->last_name,
            "Email"        => $data->email,
            "Phone Number" => $data->phone_number,
            "Gender"       => $gender,
            "Address"      => $data->address,
            "City"         => $city,
            "State"        => $state,
            "Country"      => $country,
            "Birth Date"   => $data->birth_date,
            "Age"          => $data->age,
            "Zip"          => $data->zip
        ];
    }
}
