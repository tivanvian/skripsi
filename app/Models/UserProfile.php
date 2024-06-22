<?php

namespace App\Models;

use App\Traits\HasUUID;
use App\Traits\CreatedUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasUUID;
    use HasFactory;
    use CreatedUpdated;

    protected $fillable = [
        'user_id',
        'about',
        'marital_status',
        'job_position',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'identity_address',
        'identity_region_id',
        'office_type',
        'office_name',
        'office_address',
        'office_region_id',
        'office_postal_code',
        'created_by',
        'updated_by',
    ];
}
