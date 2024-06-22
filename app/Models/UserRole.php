<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use Uuids;
    use HasFactory;

    protected $table = 'user_roles';

    protected $fillable = [
        'user_id',
        'default_role',
        'roles',
        'type',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'roles' => 'json',
    ];
}
