<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Lead;
use App\Models\LeadType;
use App\Models\AgeGroup;
use App\Models\State;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function client(){
        return $this->belongsTo(Client::class,'client_id','id');
    }

    public function lead_type(){
        return $this->belongsTo(LeadType::class,'lead_type_id','id');
    }

    public function age_group(){
        return $this->belongsTo(AgeGroup::class,'age_group_id','id')->withTrashed();
    }

    public function state(){
        return $this->belongsTo(State::class,'state_id','id');
    }
}
