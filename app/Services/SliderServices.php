<?php

namespace App\Services;

use App\Models\Slider;
use App\Models\Wilayah;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use File;

class SliderServices
{  
    public function main()
    {
        return Slider::all();
    }

    public function findBy($field, $id)
    {
        return Slider::where($field, $id)->first();
    }

    public function paramsWilayah()
    {
        return Wilayah::selectRaw("kode_pos as id, name")->get()->toArray();
    }

    public function doStore($request) 
    {
        $data = null;
        $requestData = null;
        $file = $this->uploadFile($request);

        if($file) {
            $requestData['wilayah'] = $request['wilayah'];
            $requestData['name'] = $request['name'];
            $requestData['file'] = $file['filename'];
            $requestData['extension'] = $file['extension'];
            $requestData['url']      = $file['url'];
            // dd($requestData);
            $data = Slider::create($requestData);
        } else {
            $data = null;
        }

        return $data;
    }

    public function doUpdate($request, $data) {
        // $request['detail']   = json_encode($request['detail'], true);
        if($request['is_active']) {
            $request['is_active'] = true;
        } else {
            $request['is_active'] = false;
        }

        if($request->hasFile('slider_file')){
            $file = $this->uploadFile($request, $data);
            if($file) {
                $request['file'] = $file['filename'];
                $request['extension'] = $file['extension'];
                $request['url']      = $file['url'];
            }
        }
        
        $data->update($request->all());
        return true;
    }

    public function doDelete($id) {
        $data = Slider::findOrFail($id);

        if($data)
        {
            $file = storage_path('app/public/sliders/'.$data->wilayah.'/'.$data->file);
            if(file_exists($file)) {
                unlink($file);
            }
        }

        $data->delete();

        return true;
    }

    public function uploadFile($request, $data = null)
    {
        if($request->hasFile('slider_file')) {

            if($data)
            {
                $file = storage_path('app/public/sliders/'.$data->wilayah.'/'.$data->file);
                if(file_exists($file)) {
                    unlink($file);
                }
            }
            
            $path = storage_path('app/public/sliders/'.$request->wilayah);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file = $request->file('slider_file');
            $name = uniqid() . '_' . time() . '.' .$file->getClientOriginalExtension();
            $file->move($path, $name);

            return [
                'filename'  => $name,
                'extension' => $file->getClientOriginalExtension(),
                'url'      => '/storage/sliders/'.$request->wilayah.'/'.$name,
            ];
        }

        return [];
    }

}
