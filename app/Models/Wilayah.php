<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUUID;

class Wilayah extends Model
{
    use HasUUID;
    use HasFactory;

    protected $fillable = [
        'level',
        'code',
        'city',
        'name',
        'latitude',
        'longitude',
        'detail',
        'kode_pos',
        'is_active',
    ];

    protected $casts = [
        'detail' => 'array'
    ];

    public static function paramsCity()
    {
        $data = [
            "Jakarta Pusat",
            "Jakarta Utara",
            "Jakarta Selatan",
            "Jakarta Barat",
            "Jakarta Timur",
            "Kepulauan Seribu"
        ];

        return $data;
    }

    public static function paramsLevelRegion()
    {
        $data = [
            "KEL",
            "KEC",
            "KOTA",
            "DINAS"
        ];
        
        return $data;
    }
}
