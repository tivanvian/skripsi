<?php

namespace App\Services;

/**
 * Class QueueConfigServices
 * @package App\Services
 */

use App\Models\Wilayah;
use App\Models\QueueConfig;

class QueueConfigServices
{
    public function paramsWilayah()
    {
        return Wilayah::selectRaw("kode_pos as id, name")->get()->toArray();
    }

    public function main()
    {
        return QueueConfig::all();
    }

    public function findBy($field, $id)
    {
        return QueueConfig::where($field, $id)->first();
    }

    public function doStore($request) {
        $request['pelayanan_loket']   = json_encode($request['pelayanan_loket'], true);
        // dd($request->all());
        $region = QueueConfig::create($request->all());
        return $region;
    }

    public function doUpdate($request, $region) {
        // Result structure like: [{"alias":"A", "nama":"AA"}, {"alias":"B","nama":"BB"}, {"alias":"C","nama":"CC"}]
        $formattedPelayanan = [];

        foreach ($request['pelayanan_loket'] as $person) {
            // dd($person);
            $formattedPelayanan[] = [
                'alias' => htmlspecialchars($person['alias']),
                'nama' => htmlspecialchars($person['nama'])
            ];
        }

        // Output the result as JSON
        // echo json_encode($formattedPeople);
        $request['pelayanan_loket']   = json_encode($formattedPelayanan);

        if($request['is_active']) {
            $request['is_active'] = true;
        } else {
            $request['is_active'] = false;
        }
        
        $region->update($request->all());
        return "success";
    }

    public function doDelete($wilayah) {
        $menu = QueueConfig::findOrFail($wilayah);
        $menu->delete();
        return true;
    }
}
