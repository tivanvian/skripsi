<?php

namespace App\Models;

use App\Traits\HasUUID;
use App\Traits\ModelObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    use HasFactory;
    use HasUUID;
    use ModelObserver;

    protected $table = 'parameters';

    protected $fillable = [
        'slug',
        'nama',
        'value',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'value'     => 'json',
    ];
}
