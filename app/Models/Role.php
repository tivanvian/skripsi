<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasUUID;
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'default_route',
        'is_active',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     * Access is json cloum = ['create', 'read', 'update', 'delete']
     * Menus is JSON column = ['menu1', 'menu2', 'menu3']
     */

    // to Role Menus
    public function roleMenus()
    {
        return $this->hasMany(RoleMenu::class);
    }
}
