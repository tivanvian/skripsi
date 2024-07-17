<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUUID;

class QueueConfig extends Model
{
    use HasFactory;
    use HasUUID;

    protected $fillable = [
        'wilayah',
        'pelayanan_loket',
        'jam_buka',
        'jam_tutup',
    ];

    protected $casts = [
        'pelayanan_loket' => 'array',
    ];

    public function getWilayahName()
    {
        return $this->belongsTo(Wilayah::class, 'wilayah', 'code');
    }
}
