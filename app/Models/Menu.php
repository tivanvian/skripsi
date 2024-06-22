<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasUUID;
    use HasFactory;

    protected $fillable = [
        'type',
        'icon',
        'permessions',
        'title',
        'route',
        'group',
        'menu_group_slug',
        'is_active',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     * Access is json cloum = ['create', 'read', 'update', 'delete']
     */

    public function menuGroup()
    {
        return $this->belongsTo(MenuGroup::class, 'menu_group_slug', 'slug');
    }
}
