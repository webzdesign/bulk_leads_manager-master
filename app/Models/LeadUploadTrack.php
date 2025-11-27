<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadUploadTrack extends Model
{
    use HasFactory;

    protected $table = 'lead_progress_tracking';

    protected $guarded = [];
}