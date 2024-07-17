<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUUID;

class Queue extends Model
{
    use HasFactory;
    use HasUUID;

    protected $fillable = [
        'wilayah',
        'tipe_loket',
        'number',
        'status',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];

    public static function paramsType()
    {
        $data = [
            [
                "id" => "ptsp",
                "name" => "Pelayanan PTSP",
            ],
            [
                "id" => "dukcapil",
                "name" => "Pelayanan Dukcapil",
            ],
            [
                "id" => "kelurahan",
                "name" => "Pelayanan Kelurahan",
            ],
            [
                "id" => "kecamatan",
                "name" => "Pelayanan Kecamatan",
            ],
            [
                "id" => "kota",
                "name" => "Pelayanan Kota",
            ],
        ];

        return $data;
    }
}
