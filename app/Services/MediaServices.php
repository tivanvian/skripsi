<?php
/* OKE */
namespace App\Services;

use App\Models\Media;
use App\Models\Product;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use DataTables;
use File;

class MediaServices
{
    public $mainClass = Media::class;

    public function uploadTemp($request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . time() . '_' .$file->getClientOriginalName();

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function submitSingleFile($request, $id, $class)
    {
        $media = Media::where('mediable_id', '=', $id)->first();

        if($media){
            $media->delete();
        }

        $nameFile = explode('.', $request);
        $getType = end($nameFile);

        $Data = [
            'mediable_id'   => $id,
            'mediable_type' => $class,
            'name'          => $request,
            'thumb'         => '1',
            'type'          => $getType,
            'is_active'     => '1'
        ];

        Media::create($Data);

        return true;
    }

    public function submitFile($request, $id, $class, $path)
    {

        for ($i = 0; $i < count((array)$request->document); $i++) {
            if($i == 0){
                $thumb = '1';
            }else{
                $thumb = '0';
            }

            $nameFile = explode('.', $request->document[$i]);
            $getType = end($nameFile);

            $Data = [
                'mediable_id'   => $id,
                'mediable_type' => $class,
                'name'          => $request->document[$i],
                'thumb'         => $thumb,
                'type'          => $getType,
                'is_active'     => '1'
            ];

            Media::create($Data);
        }

        foreach ($request->input('document', []) as $file) {
            File::move(storage_path('tmp/uploads/'.$file), storage_path('app/public/'.$path.'/'.$file));
        }

        File::deleteDirectory(storage_path('tmp'));

        return true;
    }

    public function doDelete($id, $path)
    {
        $data = Media::find($id);

        File::delete(public_path('app/public/'.$path.'/'.$data->name));

        $data->delete();

        return true;
    }

    public function selectThumb($id, $class, $class_id)
    {
        $d = Media::where('mediable_id', '=', $class_id)->get();
        foreach($d as $r){
            $r->thumb = '0';
            $r->save();
        }

        $data = Media::find($id);
        $data->thumb = '1';
        $data->save();

        return true;
    }

    // {
    //     $pd = Product::whereId($pid)->first();
    //     $pd->imageproduct_id = $id;
    //     $pd->save();

    //     $d = Media::where('mediable_id', '=', $pid)->get();
    //     foreach($d as $r){
    //         $r->thumb = '0';
    //         $r->save();
    //     }

    //     $data = Media::find($id);
    //     $data->thumb = '1';
    //     $data->save();

    //     return true;
    // }
}
