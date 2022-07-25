<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class, 'added_by', 'id');
    }

    public function lead_type() {
        return $this->belongsTo(LeadType::class, 'lead_type_id', 'id');
    }

    public function age_group(){
        return $this->belongsTo(AgeGroup::class,'age_group_id','id');
    }
}
