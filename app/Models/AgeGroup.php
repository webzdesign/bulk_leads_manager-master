<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgeGroup extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function leadType()
    {
        return $this->belongsTo(LeadType::class,'lead_type_id','id');
    }

}
