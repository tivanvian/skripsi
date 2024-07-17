<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Queue;
use App\Models\QueueConfig;
use App\Models\QueueCall;
use App\Models\QueueNow;
use App\Models\Wilayah;
use App\Services\QueueServices;
use App\Http\Requests\QueueRequest;

//JsonResponse
use Illuminate\Http\JsonResponse;
// use LaravelQRCode\Facades\QRCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use DataTables;


class QueueController extends Controller
{
    private $Queue;

    public function __construct(QueueServices $data)
    {
        $this->Queue = $data;
    }

    public static function pages($model = null) {
        $group      = 'admin';
        $main       = 'queue';
        $title      = 'Panggilan Antrian';
        $routeGroup = $group.'.'.$main;

        return [
            'title-bar'         => $title,
            'page'              => [
                'home'          => $group.'.home.index',
                'breadcrumb'    => [
                    'parent'    => 'Dashboard',
                    'child'     => ['title' => $title, 'url' => route($routeGroup.'.index')],
                    // 'subChild'  => 'subChild',
                ],
                'index'         => [
                    'title'     => $title,
                    'url'       => route($routeGroup.'.index'),
                    'view'      => $routeGroup.'.index',
                ],
                'create'        => [
                    'title'     => 'Create '.$title,
                    'url'       => route($routeGroup.'.create'),
                    'store'     => route($routeGroup.'.store'),
                    'view'      => $routeGroup.'.create',
                ],
                'show'          => [
                    'title'     => 'Detail '.$title,
                    'url'       => isset($model->id) ? route($routeGroup.'.show', $model->id) : '#',
                    'view'      => $routeGroup.'.show',
                ],
                'edit'          => [
                    'title'     => 'Edit '.$title,
                    'url'       => isset($model->id) ? route($routeGroup.'.edit', $model->id) : '#',
                    'update'    => isset($model->id) ? route($routeGroup.'.update', $model->id) : '#',
                    'view'      => $routeGroup.'.edit',
                ],
                'destroy'       => isset($model->id) ? route($routeGroup.'.destroy', $model->id) : '#',
                'delete'        => isset($model->id) ? route($routeGroup.'.delete', $model->id) : '#',
            ],
        ];
    }

    public static function tableProperties()
    {
        return [
            'columnDefs'   => [
                [
                    'className' => 'text-center', 'targets' => '2, 3'
                ]
            ],
            'columns'      =>[
                [
                    'width' => "20%",
                    'label' => __('Tanggal'),
                    'slug'  => 'tanggal'
                ],
                [
                    'width' => "30%",
                    'label' => __('Pelayanan'),
                    'slug'  => 'tipe_loket'
                ],
                [
                    'width' => "25%",
                    'label' => __('Nomor Antrian'),
                    'slug'  => 'number'
                ],
                [
                    'width' => "15%",
                    'label' => __('Status'),
                    'slug'  => 'status'
                ],
                [
                    'width' => "10%",
                    'label' => __('Action'),
                    'slug'  => 'action'
                ],
            ],
        ];
    }


    // public static function formGenerateCreate($params = []){
    //     return [
    //         [
    //             "class"         => "col-md-12 col-sm-12",
    //             "form"          => FormText("Kode Wilayah", "code", "code", true),
    //         ],
    //         [
    //             "class"         => "col-md-12 col-sm-12",
    //             "form"          => FormText("Nama Wilayah", "name", "name", true),
    //         ],
    //         [
    //             "class"         => "col-md-12 col-sm-12",
    //             "form"          => '<div class="mb-3">
	// 									<label class="form-label" for="username">Alamat</label>
	// 									<textarea class="form-control" name="detail[address]" id="detail.address" rows="3">'.old("detail.address").'</textarea>
	// 								</div>',
    //         ],
    //         [
    //             "class"         => "col-md-12 col-sm-12",
    //             "form"          => FormText("Kode Pos", "detail[postal_code]", "Postal Code", true),
    //         ],
    //         [
    //             "class"         => "col-md-12 col-sm-12",
    //             "form"          => FormText("Latitude", "latitude", "latitude", true),
    //         ],
    //         [
    //             "class"         => "col-md-12 col-sm-12",
    //             "form"          => FormText("Longitude", "longitude", "longitude", true),
    //         ],
    //         [
    //             "class"         => "col-md-12 col-sm-12",
    //             "form"          => FormSelect("Kota", 'city', "Pilih Kota", $params['city'], true),
    //         ],
    //         [
    //             "class"         => "col-md-12 col-sm-12",
    //             "form"          => FormSelect("Level Wilayah", 'level', "Pilih Level", $params['level'], true),
    //         ],
    //         [
    //             "class"         => "col-md-12 col-sm-12",
    //             "form"          => FormText("Telepon", "detail[telphone]", "Telepon", true),
    //         ],
    //         [
    //             "class"         => "col-md-12 col-sm-12",
    //             "form"          => FormText("Email", "detail[email]", "Email", true),
    //         ],
    //     ];
    // }

    // public static function formGenerateEdit($params = [], $data, $readonly = false){
    //     //Check Active
    //     if($data->is_active == true){
    //         $checked = 'checked';
    //     }else{
    //         $checked = '';
    //     }
        
    //     return [
    //         [
    //             "class"         => "col-md-12 col-sm-12",
    //             "column"        => [
    //                 "active"    => true,
    //                 "columns"   => [
    //                     [
    //                         "class" => "col-md-9 col-sm-8",
    //                         "form"  => FormText("Kode Wilayah", "code", "code", true, $data->code, $readonly) ,
    //                     ],
    //                     [
    //                         "class" => "col-md-3 col-sm-4",
    //                         "form"  => "<label class='form-check pt-4'>
    //                                         <input class='form-check-input' type='checkbox' ".$checked." name='is_active' />
    //                                         <span class='form-check-label'> Aktif </span>
    //                                     </label>",
    //                     ],
    //                     [
    //                         "class"         => "col-md-12 col-sm-12",
    //                         "form"          => FormText("Nama Wilayah", "name", "name", true, $data->name, $readonly),
    //                     ],
    //                     [
    //                         "class"         => "col-md-12 col-sm-12",
    //                         "form"          => '<div class="mb-3">
    //                                                 <label class="form-label" for="username">Alamat</label>
    //                                                 <textarea class="form-control" name="detail[address]" id="detail.address" rows="3">'.RenderJson($data->detail, "address").'</textarea>
    //                                             </div>',
    //                     ],
    //                     [
    //                         "class"         => "col-md-12 col-sm-12",
    //                         "form"          => FormText("Kode Pos", "detail[postal_code]", "Postal Code", true, RenderJson($data->detail, "postal_code"), $readonly),
    //                     ],
    //                     [
    //                         "class"         => "col-md-12 col-sm-12",
    //                         "form"          => FormText("Latitude", "latitude", "latitude", true, $data->latitude, $readonly),
    //                     ],
    //                     [
    //                         "class"         => "col-md-12 col-sm-12",
    //                         "form"          => FormText("Longitude", "longitude", "longitude", true, $data->longitude, $readonly),
    //                     ],
    //                     [
    //                         "class"         => "col-md-12 col-sm-12",
    //                         "form"          => FormSelect("Kota", 'city', "Pilih Kota", $params['city'], true, $data->city),
    //                     ],
    //                     [
    //                         "class"         => "col-md-12 col-sm-12",
    //                         "form"          => FormSelect("Level Wilayah", 'level', "Pilih Level", $params['level'], true, $data->level),
    //                     ],
    //                     [
    //                         "class"         => "col-md-12 col-sm-12",
    //                         "form"          => FormText("Telepon", "detail[telphone]", "Telepon", true, RenderJson($data->detail, "telphone"), $readonly),
    //                     ],
    //                     [
    //                         "class"         => "col-md-12 col-sm-12",
    //                         "form"          => FormText("Email", "detail[email]", "Email", true, RenderJson($data->detail, "email"), $readonly),
    //                     ],
    //                 ]
    //             ],
    //         ]
    //     ];
    // }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Queue::selectRaw('*, CASE WHEN status = "waiting" THEN 1 ELSE 2 END as status_order')
                ->where('tanggal', date('Y-m-d'))
                ->orderBy('status_order', 'ASC')
                ->orderBy('number', 'ASC')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    return Status($row->is_active);
                })
                ->addColumn('action', function($row){
                    $dataButton = '';
                    if($row->status == 'waiting'){
                        $dataButton .= '<button type="button" data-action="'.route('antrian.post-call', [$row->wilayah, 'server', $row->tipe_loket, $row->number]).'" class="btn btn-primary btn-sm hover-up btnCall">Call</button>';
                        $dataButton .= '<button type="button" data-action="'.route('admin.queue.finish', [$row->id]).'" class="btn btn-success btn-sm hover-up btnFinish">Finish</button>';
                    } else {
                        $dataButton .= 'Already Finish';
                    }

                    return $dataButton;
                    // $pages = $this->pages($row);

                    // $dataLink = [
                    //     'show' => [
                    //         'url' => $pages['page']['show']['url'],
                    //         'label' => "View",
                    //     ],
                    //     'edit' => [
                    //         'url' => $pages['page']['edit']['url'],
                    //         'label' => "Edit",
                    //     ],
                    //     'delete' => [
                    //         'url'   => $pages['page']['delete'],
                    //         'id'    => $row->id,
                    //         'label' => "Delete",
                    //     ],
                    // ];
                    // return MenuButtonAction([], $dataLink);
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view($this->pages()['page']['index']['view'], [
            'pages'             => $this->pages(),
            'tableProperties'   => $this->tableProperties(),
        ]);
    }

    public function finish($id)
    {
        $data = Queue::find($id);
        $data->status = 'finish';
        $data->save();

        return response()->json(['success'=>true]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $pages = $this->pages();

    //     return view($pages['page']['create']['view'], [
    //         'pages'         => $pages,
    //         'pagesSubChild' => [
    //             'active'    => true,
    //             'title'     => $pages['page']['create']['title'],
    //         ],
    //         'formGenerator' => $this->formGenerateCreate([
    //             'city'          => $this->Queue->paramsCity(),
    //             'level'         => $this->Queue->paramsLevelRegion(),
    //         ]),
    //         'params'        => [
    //             'city'          => $this->Queue->paramsCity(),
    //             'level'         => $this->Queue->paramsLevelRegion(),
    //         ],
    //     ]);
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(WilayahRequest $request)
    // {
    //     $this->Queue->doStore($request);

    //     session()->flash('success', __('Data berhasil disimpan !'));

    //     return redirect()->to($this->pages()['page']['index']['url']);
    // }

    /**
     * Display the specified resource.
     */
    // public function show(Wilayah $wilayah)
    // {
    //     $pages = $this->pages($wilayah);

    //     return view($pages['page']['show']['view'], [
    //         'pages'         => $pages,
    //         'pagesSubChild' => [
    //             'active'    => true,
    //             'title'     => $pages['page']['show']['title'],
    //         ],
    //         'formGenerator' => $this->formGenerateEdit([
    //             'city'          => $this->Queue->paramsCity(),
    //             'level'         => $this->Queue->paramsLevelRegion(),
    //         ], $wilayah, true),
    //         'id'            => $wilayah->id,
    //     ]);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Wilayah $wilayah)
    // {
    //     $pages = $this->pages($wilayah);

    //     return view($this->pages()['page']['edit']['view'], [
    //         'pages'         => $pages,
    //         'pagesSubChild' => [
    //             'active'    => true,
    //             'title'     => $pages['page']['edit']['title'],
    //         ],
    //         'formGenerator' => $this->formGenerateEdit([
    //             'city'          => $this->Queue->paramsCity(),
    //             'level'         => $this->Queue->paramsLevelRegion(),
    //         ], $wilayah),
    //         'id'            => $wilayah->id,
    //     ]);
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Wilayah $wilayah)
    // {
    //     $data = $this->Queue->doUpdate($request, $wilayah);

    //     if($data == true){
    //         session()->flash('success', __('Data berhasil diubah !'));
    //         return redirect()->back();
    //     } else {
    //         session()->flash('error', __('Data gagal diubah !'));
    //         return redirect()->back();
    //     }
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     //
    // }

    // public function delete($id)
    // {
    //     $data = $this->Queue->doDelete($id);

    //     if($data){
    //         response()->json(['success'=>true]);
    //     } else {
    //         response()->json(['success'=>false]);
    //     }
    // }

    public function antrianHome()
    {
        $authWilayah = \Auth::user()->wilayah;

        $config = QueueConfig::where('wilayah', $authWilayah)->first();
        $wilayah = Wilayah::where('kode_pos', $authWilayah)->first();
        // dd($config);

        return view('antrian',
            [
                'authWilayah'       => $authWilayah,
                'config'            => $config,
                'wilayah'           => $wilayah,
                'pelayananLoket'    => json_decode($config->pelayanan_loket, true),
            ]
        );
    }

    public function antrianDisplay()
    {
        $authWilayah = \Auth::user()->wilayah;

        $config = QueueConfig::where('wilayah', $authWilayah)->first();
        $wilayah = Wilayah::where('kode_pos', $authWilayah)->first();
        // dd($config);

        return view('display',
            [
                'authWilayah'       => $authWilayah,
                'config'            => $config,
                'wilayah'           => $wilayah,
                'pelayananLoket'    => json_decode($config->pelayanan_loket, true),
            ]
        );
    }

    public function getAntrian(Request $request) : JsonResponse
    {
        $request->validate([
            'tipe_loket'    => ['required', 'string'],
            'kode_wilayah'  => ['required', 'string'],
        ],
        [
            'tipe_loket.required'   => 'Tipe Loket tidak boleh kosong',
            'kode_wilayah.required' => 'Kode Pos tidak boleh kosong',
        ]
        );

        $data = Queue::create([
            'tipe_loket'    => $request->tipe_loket,
            'wilayah'       => $request->kode_wilayah,
            'tanggal'       => date('Y-m-d'),
            'number'        => $this->Queue->getNumberAntrian($request->tipe_loket, $request->kode_wilayah),
            'status'        => 'waiting',
        ]);

        return response()->json([
            'success'   => true,
            'data'      => $data,
            'link'    => route('antrian.queue', $data->id),
        ]);
    }

    public function antrianLoginPost(Request $request)
    {
        //validated
        $request->validate([
            'kode_wilayah'  => ['required', 'string','min:5', 'max:5', 'regex:/^[^(\|\]~`!%^&*=};:?><’)]*$/']
        ],
        [
            'kode_wilayah.required' => 'Kode Pos tidak boleh kosong',
            'kode_wilayah.min'      => 'Kode Pos harus 5 Digit',
            'kode_wilayah.max'      => 'Kode Pos harus 5 Digit',
            'kode_wilayah.regex'    => 'Kode Pos Tidak Sesuai Format'
        ]
        );

        return $this->Queue->doLoginWilayah($request);

        // if($data){
        //     return redirect()->route('antrian.home');
        // } else {
        //     return redirect()->back();
        // }
    }

    public function antrianQueue($id)
    {
        $data = Queue::find($id);
        if($data){
            return response()->json([
                'success'   => true, 
                'data'      => $data, 
                'qrCode'    => '',
            ]);
        } else {
            return response()->json(['error' => 'Data tidak ditemukan !']);
        }
    }

    public function antrianGetCall($wilayah)
    {
        $data = QueueCall::where('wilayah', $wilayah)
            ->where('status', 1)
            ->orderBy('number', 'DESC')
            ->first();

        if($data){
            return response()->json([
                'success'   => true, 
                'data'      => $data, 
            ]);
        } else {
            return response()->json([
                'success'   => false,
                'error'     => 'Data tidak ditemukan !'
            ]);
        }
    }

    public function antrianGetNow($wilayah)
    {
        $data = QueueNow::where('wilayah', $wilayah)->where('tanggal', date('Y-m-d'))->get();

        if($data){
            return response()->json([
                'success'   => true, 
                'data'      => $data, 
            ]);
        } else {
            return response()->json([
                'success'   => false,
                'error'     => 'Data tidak ditemukan !'
            ]);
        }
    }

    public function antrianPostCall($wilayah, $caller, $loket = null, $number = null)
    {
        $data = QueueCall::where('wilayah', $wilayah)->where('status', 1)->first();

        if($caller == 'client'){
            if($data){
                $data->status = 0;
                $data->save();
            }

            return response()->json([
                'success'   => true, 
                'data'      => $data, 
            ]);
        }
        
        $dataServer = QueueCall::where('wilayah', $wilayah)->whereIn('status', [0, 1])->first();
        if($caller == 'server'){
            if($dataServer){
                $dataServer->loket = $loket;
                $dataServer->number = $number;
                $dataServer->sound_call = "Nomo Antrian, ".$number.". Silahkan Menuju Loket. ".$loket.".";
                $dataServer->status = 1;
                $dataServer->save();
            } else {
                $data = QueueCall::create([
                    'wilayah'       => $wilayah,
                    'loket'         => $loket,
                    'number'        => $number,
                    'sound_call'    => "Nomo Antrian, ".$number.". Silahkan Menuju Loket. ".$loket.".",
                    'status'        => 1,
                ]);
            }

            //Queu Now
            $dataQueueNow = QueueNow::where('wilayah', $wilayah)->where('loket', $loket)->where('tanggal', date('Y-m-d'))->first();
            if($dataQueueNow){
                $dataQueueNow->number = $number;
                $dataQueueNow->loket = $loket;
                $dataQueueNow->updated_at = date('Y-m-d');
                $dataQueueNow->save();
            } else {
                $dataQueueNow = QueueNow::create([
                    'wilayah'       => $wilayah,
                    'number'        => $number,
                    'loket'         => $loket,
                    'tanggal'       => date('Y-m-d'),
                ]);
            }

            return response()->json([
                'success'   => true, 
                'data'      => $data, 
            ]);
        }
    }
}
