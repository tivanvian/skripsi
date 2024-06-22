<?php

namespace App\Models;

use App\Traits\HasUUID;
use App\Traits\ModelObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuGroup extends Model
{
    use HasUUID;
    use HasFactory;
    use ModelObserver;

    protected $fillable = [
        'slug',
        'name',
        'description',
        'is_active',
        'order',
        'created_by',
        'updated_by',
    ];
}
