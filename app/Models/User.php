<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\HasApiTokens;
use Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasUUID;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_confirmed',
        'is_active',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_confirmed'      => 'boolean',
        'is_active'         => 'boolean',
    ];

    public function getDefaultRole()
    {
        return $this->hasOne(UserRole::class, 'user_id', 'id')->pluck('default_role')->first();
    }

    public function getTypeRole()
    {
        return $this->hasOne(UserRole::class, 'user_id', 'id')->pluck('type')->first();
    }

    public function getUserPhoto()
    {
        return $this->morphOne(Media::class, 'mediable');
    }

    public function UserRoles()
    {
        return $this->hasOne(UserRole::class, 'user_id', 'id')->select(['id', 'user_id', 'roles as name']);
    }

    // public function UserProfileData()
    // {
    //     return $this->hasOne(UserProfile::class, 'user_id', 'id');
    // }

    public function UserPhoto()
    {
        return $this->morphOne(Media::class, 'mediable')->pluck('name')->first();
    }

    // protected function type(): Attribute
    // {
    //     return new Attribute(
    //         get: fn ($value) =>  ["user", "admin"][$value],
    //     );
    // }

    public static function menuRender(){
        $class = '';
        $role = RoleMenu::where('role_slug', session('default_role'))->orderBy("menu_group")->get()->pluck('menu_group');
        $menuGroup = MenuGroup::where('is_active', true)->get();

        $menuDashboard = Menu::whereRoute('admin.aindex')->whereIn('group', $role)->first();
        $menuDashboardV2 = Menu::whereRoute('admin.aindex')->whereIn('group', $role)->first();

        if($menuDashboard){
            $class .= '<li class="menu-item '.self::ActiveMenuGroup($menuDashboard->group).'">';
            $class .= '<a class="menu-link" href="'.route($menuDashboard->route).'">';
            $class .= '<i class="icon material-icons '.$menuDashboard->icon.'"></i>';
            $class .= '<span class="text">'.$menuDashboard->title.'</span>';
            $class .= '</a>';
            $class .= '</li>';
        }

        if($menuDashboardV2){
            $class .= '<li class="menu-item '.self::ActiveMenuGroup($menuDashboardV2->group).'">';
            $class .= '<a class="menu-link" href="'.route($menuDashboard->route).'">';
            $class .= '<i class="icon material-icons '.$menuDashboardV2->icon.'"></i>';
            $class .= '<span class="text">'.$menuDashboardV2->title.'</span>';
            $class .= '</a>';
            $class .= '</li>';
        }

        foreach ($menuGroup as $item) {
            $query = Menu::whereRaw("route ilike '%index%'")->whereMenuGroupSlug($item->slug)->where('menu_group_slug', '!=', 'dashboard')->whereIn('group', $role);

            //Get Menu
            $menu = $query->get();

            //Group Menu
            $getGroup = $query->select('menu_group_slug')->groupBy('menu_group_slug')->get()->pluck('menu_group_slug');

            //Render Header Menu Group
            if(in_array($item->slug, $getGroup->toArray())){
                $class .= '<li class="menu-group">';
                $class .= '    <span class="header">'.$item->name.'</span>';
                $class .= '</li>';
                $class .= '<hr class="menu-group-line"/>';
            }

            //Render Menu
            foreach ($menu as $item) {
                $class .= '<li class="menu-item '.self::ActiveMenuGroup($item->group).'">';
                $class .= '<a class="menu-link" href="'.route($item->route).'">';
                $class .= '<i class="icon material-icons '.$item->icon.'"></i>';
                $class .= '<span class="text">'.$item->title.'</span>';
                $class .= '</a>';
                $class .= '</li>';
            }
        }

		return $class;
    }

    public static function ActiveMenu($name){
        return (Route::currentRouteName() == $name || request()->route()->getName() == $name) ? 'active' : '';
    }

    public static function ActiveMenuGroup($name){
        return (explode(".",Route::currentRouteName())[1] == $name) ? 'active' : '';
    }
}
