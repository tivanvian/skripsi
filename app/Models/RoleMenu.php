<?php

namespace App\Models;

use App\Traits\HasUUID;
use App\Traits\CreatedUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    use HasUUID;
    use HasFactory;
    use CreatedUpdated;

    protected $fillable = [
        'role_id',
        'role_slug',
        'menu_group',
        'access',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'access' => 'json',
    ];

    //to Role where group
    public function getMenuName()
    {
        return $this->belongsTo(Menu::class, 'menu_group', 'group')->whereRaw("route like '%index%'")->first();
    }

    // //getGroupName
    // public function getMenuName()
    // {
    //     dd($this->Model);
    //     return $this->Model->whereRaw('route like "%index%"')->first();
    // }
}
