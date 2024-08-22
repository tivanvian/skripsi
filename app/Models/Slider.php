<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUUID;

class Slider extends Model
{
    use HasFactory;
    use HasUUID;

    protected $table = 'sliders';

    protected $fillable = [
        'wilayah',
        'name',
        'file',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
