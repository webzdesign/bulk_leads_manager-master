<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function ageGroup() {
        return $this->hasMany(AgeGroup::class, 'lead_type_id');
    }

    public function leads() {
        return $this->hasMany(Lead::class, 'lead_type_id');
    }
}
