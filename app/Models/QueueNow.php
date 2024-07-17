<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueueNow extends Model
{
    use HasFactory;

    protected $table = 'queue_nows';

    protected $fillable = [
        'wilayah',
        'loket',
        'number',
        'tanggal',
    ];
}
