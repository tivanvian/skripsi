<?php

namespace App\Services;

use App\Models\Parameter;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use DataTables;

class ParameterServices
{
    public $mainClass = Parameter::class;

    public function main()
    {
        return $this->mainClass::whereIsActive('t')->get();
    }

    public function findBy($field, $id)
    {
        return $this->mainClass::whereIsActive('t')->where($field, $id)->first();
    }

    public function doStore($request) {

        $data = $this->mainClass::create($request->all());

        return $data;

    }

    public function doUpdate($request, $data) {
        $newValue = json_encode(array_values($request->value));
        $request->value = $newValue;
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
