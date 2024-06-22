<?php
/* OKE */
namespace App\Services;

use App\Models\MenuGroup;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use DataTables;

class MenuGroupServices
{
    public $mainClass = MenuGroup::class;

    public function main()
    {
        return $this->mainClass::whereIsActive('t')->get();
    }

    public function findBy($field, $id)
    {
        return $this->mainClass::whereActive('t')->where($field, $id)->first();
    }

    public function doStore($request) {
        $request['slug']            = Str::slug($request['name'], '-');

        $data = $this->mainClass::create($request->all());

        return $data;
    }

    public function doUpdate($request, $data) {
        //Update to Datapase
        $request['slug']            = Str::slug($request['name'], '-');

        //Handle Menus
        if($request['is_active']) {
            $request['is_active'] = true;
        } else {
            $request['is_active'] = false;
        }

        $data->update($request->all());

        return true;
    }

    public function doDelete($data) {
        $data = $this->mainClass::findOrFail($data);
        $data->delete();
        return true;
    }
}
