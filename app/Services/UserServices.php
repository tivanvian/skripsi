<?php
/* OKE */
namespace App\Services;

use App\Models\User;
use App\Models\UserRole;
use App\Models\UserProfile;
use App\Models\Role;
use App\Models\Wilayah;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use DataTables;

class UserServices
{
    public $mainClass = User::class;

    public function main()
    {
        return $this->mainClass::whereIsActive('t')->get();
    }

    public function findBy($field, $id)
    {
        return $this->mainClass::whereActive('t')->where($field, $id)->first();
    }

    public function paramsRole($multiple = true)
    {
        if($multiple){
            return Role::select(['slug as id', 'name'])->get()->toArray();
        } else {
            return Role::select(['slug as id', 'name'])->get()->toArray();
        }
    }

    public function paramsGender(){
        return [
            ["id" => "1", "name" => "Man"],
            ["id" => "2", "name" => "Woman"],
        ];
    }

    public function paramsWilayah()
    {
        return Wilayah::selectRaw("kode_pos as id, name")->get()->toArray();
    }

    // public function paramsRegion(){
    //     return Region::selectRaw("id, concat(village_name, ', ', district_name, ', ', province_name) as name")->get()->toArray();
    // }

    public function dataUserRoles($user)
    {
        return (!empty($user->UserRoles)) ? json_decode($user->UserRoles->name) : '';
    }

    public function doStore($request) {
        $request['name']            = ucwords($request['name']);
        $request['email']           = strtolower($request['email']);
        $request['password']        = bcrypt($request['password']);

        $user = $this->mainClass::create($request->all());

        //Create User Role
        $this->CreateUserRole($request, $user);

        return $user;
    }

    public function CreateUserRole($request, $user)
    {
        if(!isset($request['user_role'])) {
            $requestUserRole = [$request['default_role']];
        } else {
            $requestUserRole = $request['user_role'];
        }

        $userRole               = new UserRole;
        $userRole->user_id      = $user->id;
        $userRole->default_role = $request['default_role'];

        if($request['default_role'] == 'user') {
            $userRole->type = 'user';
        } else {
            $userRole->type = 'admin';
        }

        $userRole->roles        = $requestUserRole;
        $userRole->save();
    }

    public function UpdateUserRole($request, $user)
    {
        if($user->UserRoles) {
            $user->UserRoles->default_role = $request['default_role'];
            $user->UserRoles->roles = $request['user_role'];

            if($request['default_role'] == 'user') {
                $user->UserRoles->type = 'user';
            } else {
                $user->UserRoles->type = 'admin';
            }

            $user->UserRoles->save();
        } else {
            $this->CreateUserRole($request, $user);
        }

    }

    public function UserProfileModule($id, $request)
    {
        $data = UserProfile::whereUserId($id)->first();
        if($data) {
            $data->update($request->all());
        } else {
            $request['user_id'] = $id;
            UserProfile::create($request->all());
        }
    }

    public function doUpdate($request, $user) {

        //Update to Datapase
        $request['name']            = ucwords($request['name']);
        $request['email']           = strtolower($request['email']);

        if($request['password'] != null) {
            $request['password'] = bcrypt($request['password']);
        } else {
            unset($request['password']);
        }


        if($request['is_confirmed']) {
            $request['is_confirmed'] = true;
        } else {
            $request['is_confirmed'] = false;
        }

        if($request['is_active']) {
            $request['is_active'] = true;
        } else {
            $request['is_active'] = false;
        }

        $user->update($request->all());

        //Update User Role
        if($request['user_role'] && $request['default_role']) {
            $this->UpdateUserRole($request, $user);
        }

        //Update Profile
        $this->UserProfileModule($user->id, $request);

        //Update FOto Profile
        if(!empty($request["profile_pictures"])){
            //TO Media Service
            $fileName = UploadFile($request["profile_pictures"], 'profile', $user->UserPhoto(), null, 'storage');

            $mediaService = new MediaServices;

            $mediaService->submitSingleFile($fileName, $user->id, 'App\Models\User');
        }

        return true;
    }

    public function doDelete($user) {
        $user = $this->mainClass::findOrFail($user);

        //Delete in User Role
        if($user->UserRoles) {
            $user->UserRoles->delete();
        }

        //Delete in User Profile
        if($user->UserProfileData) {
            $user->UserProfileData->delete();
        }

        //Delete in User Photo
        if($user->getUserPhoto) {
            $user->getUserPhoto->delete();
        }

        $user->delete();
        return true;
    }
}
