<?php

namespace App\Services;

use App\Models\Wilayah;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

/**
 * Class WilayahServices
 * @package App\Services
 */
class WilayahServices
{
    public function main()
    {
        return Wilayah::all();
    }

    public function findBy($field, $id)
    {
        return Wilayah::where($field, $id)->first();
    }

    public function paramsCity()
    {
        $data = Wilayah::paramsCity();
        $data = collect($data)->map(function ($item) {
            return [
                'id' => $item,
                'name' => $item
            ];
        });
        return $data;
    }

    public function paramsLevelRegion()
    {
        $data = Wilayah::paramsLevelRegion();
        $data = collect($data)->map(function ($item) {
            return [
                'id' => $item,
                'name' => $item
            ];
        });
        return $data;
    }

    public function doStore($request) {
        $request['detail']   = json_encode($request['detail'], true);
        $region = Wilayah::create($request->all());
        return $region;
    }

    public function doUpdate($request, $region) {
        $request['detail']   = json_encode($request['detail'], true);
        if($request['is_active']) {
            $request['is_active'] = true;
        } else {
            $request['is_active'] = false;
        }
        
        $region->update($request->all());
        return "success";
    }

    public function doDelete($wilayah) {
        $menu = Wilayah::findOrFail($wilayah);
        $menu->delete();
        return true;
    }
}
