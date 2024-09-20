<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueueCall extends Model
{
    use HasFactory;

    protected $table = 'queue_calls';

    protected $fillable = [
        'wilayah',
        'loket',
        'alias',
        'number',
        'sound_call',
        'status',
    ];
}
