<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id','id');
    }

    public function lead_type()
    {
        return $this->belongsTo(LeadType::class,'lead_type_id','id');
    }

    public function age_group()
    {
        return $this->belongsTo(AgeGroup::class,'age_group_id','id');
    }

}
