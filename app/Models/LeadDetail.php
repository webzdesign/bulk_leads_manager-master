<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    protected $table = 'lead_details';
    protected $fillable =['firstname','lastname','gender','email','address','countru_id','state_id','city_id','phone_number','birth_date','age','zip','date_genrated','is_duplicate','is_invalid','is_send','deleted_at','lead_id','age_group_id'];

    public function lead()
    {
        return $this->belongsTo(Lead::class,'lead_id','id');
    }

    public function state()
    {
        return $this->belongsTo(State::class,'state_id','id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id','id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }

}

