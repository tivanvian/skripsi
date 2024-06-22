<?php

namespace App\Models;

use App\Traits\HasUUID;
use App\Traits\CreatedOnly;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasUUID;
    use HasFactory;
    use CreatedOnly;

    protected $table = 'medias';

    protected $fillable = [
        'name',
        'mediable_id',
        'mediable_type',
        'thumb',
        'type',
        'is_active',
        'created_by'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'next'    => 'json',
    // ];
}
