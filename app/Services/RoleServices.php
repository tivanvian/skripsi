<?php
/* OKE */
namespace App\Services;

use App\Models\Role;
use App\Models\RoleMenu;
use App\Models\Menu;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use DataTables;

class RoleServices
{
    public $mainClass = Role::class;

    public function main()
    {
        return $this->mainClass->whereIsActive('t')->get();
    }

    public function findBy($field, $id)
    {
        return $this->mainClass->whereActive('t')->where($field, $id)->first();
    }

    public function paramsMenu($multiple = true){
        if($multiple){
            return Menu::select(['group as id', 'title as name'])->whereRaw("route ilike '%index%'")->get()->toArray();
        } else {
            return Menu::select(['route as id', 'title as name'])->whereRaw("route ilike '%index%'")->get()->toArray();
        }
    }

    public function doStore($request) {
        $request['slug']            = Str::slug($request['name'], '-');

        //Handle Access
        // $request['access']          = Arr::flatten($request['access']);

        //Handle Role
        $role = $this->mainClass::create($request->all());
        //For Dummy
        // $role = '';
        // $role["id"]       = '1';
        // $role["slug"]     = $request['slug'];

        //Plot to Role Menus
        $this->doStoreInRoleMenus($request, $role);

        return $role;
    }

    public function doStoreInRoleMenus($request, $role, $update = false) {
        //Delete in RoleMenu
        if($update) {
            RoleMenu::where('role_id', $role['id'])->delete();
        }

        //Insert
        $roleMenus = $request['role_menus'];

        foreach($roleMenus as $key => $value) {
            foreach($value as $k => $v) {
                $data = [
                    'role_id'       => $role['id'],
                    'role_slug'     => $role['slug'],
                    'menu_group'    => $v['name'],
                    'access'        => $v['access'],
                ];

                //Insert to RoleMnu
                RoleMenu::create($data);
            }
        }
    }

    public function doUpdate($request, $role) {

        //Update to Datapase
        $request['slug']            = Str::slug($request['name'], '-');

        //Handle Menus
        if($request['is_active']) {
            $request['is_active'] = true;
        } else {
            $request['is_active'] = false;
        }

        $role->update($request->all());

        //Plot to Role Menus
        $this->doStoreInRoleMenus($request, $role, true);

        return true;
    }

    public function doDelete($role) {
        $role = $this->mainClass::findOrFail($role);
        $role->delete();
        return true;
    }
}
