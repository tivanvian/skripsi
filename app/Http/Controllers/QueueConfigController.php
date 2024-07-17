<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\QueueConfig;
use App\Models\Wilayah;
use App\Services\QueueConfigServices;
use App\Http\Requests\QueueConfigRequest;
use DataTables;


class QueueConfigController extends Controller
{
    public function __construct(QueueConfigServices $data)
    {
        $this->QueueConfig = $data;
    }

    public static function pages($model = null) {
        $group      = 'admin';
        $main       = 'queue-config';
        $title      = 'Pengaturan Antrian';
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

    public static function tableProperties(){
        return [
            'columnDefs'   => [
                [
                    'className' => 'text-center', 'targets' => '2, 3'
                ]
            ],
            'columns'      =>[
                [
                    'width' => "10%",
                    'label' => __('Wilayah'),
                    'slug'  => 'wilayah'
                ],
                [
                    'width' => "30%",
                    'label' => __('Nama Wilayah'),
                    'slug'  => 'nama_wilayah'
                ],
                [
                    'width' => "16%",
                    'label' => __('Jam Buka'),
                    'slug'  => 'jam_buka'
                ],
                [
                    'width' => "16%",
                    'label' => __('Jam Tutup'),
                    'slug'  => 'jam_tutup'
                ],
                [
                    'width' => "8%",
                    'label' => __('Action'),
                    'slug'  => 'action'
                ],
            ],
        ];
    }


    public static function formGenerateCreate($params = []){
        return [
            [
                "class"         => "col-md-8 col-sm-8",
                "form"          => FormSelect2("Wilayah", 'wilayah', "Wilayah", $params['wilayah'], false, true),
            ],
            // [
            //     "class"         => "col-md-6 col-sm-6",
            //     "form"          => '
            //                     <div class="mb-1">
            //                         <label class="form-label" for="jam_buka">Jam Buka<span class="text-danger">*</span></label>
            //                         <input id="jam_buka" name="jam_buka" value="" placeholder="" type="time" class="form-control form-control-sm " required="">
            //                     </div>
            //     ',
            // ],
            // [
            //     "class"         => "col-md-6 col-sm-6",
            //     "form"          => '
            //                     <div class="mb-1">
            //                         <label class="form-label" for="jam_tutup">Jam Buka<span class="text-danger">*</span></label>
            //                         <input id="jam_tutup" name="jam_tutup" value="" placeholder="" type="time" class="form-control form-control-sm " required="">
            //                     </div>
            //     ',
            // ],
            [
                "class"         => "col-md-12 col-sm-12",
                "column"        => [
                    "active"    => true,
                    "columns"   => [
                        [
                            "class" => "col-md-6 col-sm-6",
                            "form"          => '
                                                    <div class="mb-1">
                                                        <label class="form-label" for="jam_buka">Jam Buka<span class="text-danger">*</span></label>
                                                        <input id="jam_buka" name="jam_buka" value="" placeholder="" type="time" class="form-control form-control-sm " required="">
                                                    </div>
                                                ' ,
                        ],
                        [
                            "class" => "col-md-6 col-sm-6",
                            "form"          => '
                                                <div class="mb-1">
                                                    <label class="form-label" for="jam_tutup">Jam Buka<span class="text-danger">*</span></label>
                                                    <input id="jam_tutup" name="jam_tutup" value="" placeholder="" type="time" class="form-control form-control-sm " required="">
                                                </div>
                                            ' ,
                        ]
                    ]
                ],
            ]
        ];
    }

    public static function formGenerateEdit($params = [], $data, $readonly = false)
    {    
        return [
            [
                "class"         => "col-md-12 col-sm-12",
                "column"        => [
                    "active"    => true,
                    "columns"   => [
                        [
                            "class"         => "col-md-10 col-sm-10",
                            "form"          => FormSelect2("Wilayah", 'wilayah', "Wilayah", $params['wilayah'], false, true, $data->wilayah, $readonly),
                        ],
                        // [
                        //     "class"         => "col-md-6 col-sm-6",
                        //     // "form"          => FormText("Jam Buka", "jam_buka", "jam_buka", true, $data->jam_buka, $readonly),
                        //     "form"          => '
                        //         <div class="mb-1">
                        //             <label class="form-label" for="jam_buka">Jam Buka<span class="text-danger">*</span></label>
                        //             <input id="jam_buka" name="jam_buka" value="'.$data->jam_buka.'" placeholder="" type="time" class="form-control form-control-sm " required="">
                        //         </div>
                        //     ' ,
                        // ],
                        // [
                        //     "class"         => "col-md-6 col-sm-6",
                        //     // "form"          => FormText("Jam Tutup", "jam_tutup", "jam_tutup", true, $data->jam_tutup, $readonly),
                        //     "form"          => '
                        //         <div class="mb-1">
                        //             <label class="form-label" for="jam_tutup">Jam Buka<span class="text-danger">*</span></label>
                        //             <input id="jam_tutup" name="jam_tutup" value="'.$data->jam_tutup.'" placeholder="" type="time" class="form-control form-control-sm " required="">
                        //         </div>
                        //     ' ,
                        // ],
                        
                    ]
                ],
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "column"        => [
                    "active"    => true,
                    "columns"   => [
                        [
                            "class" => "col-md-6 col-sm-6",
                            "form"          => '
                                                    <div class="mb-1">
                                                        <label class="form-label" for="jam_buka">Jam Buka<span class="text-danger">*</span></label>
                                                        <input id="jam_buka" name="jam_buka" value="'.$data->jam_buka.'" placeholder="" type="time" class="form-control form-control-sm " required="">
                                                    </div>
                                                ' ,
                        ],
                        [
                            "class" => "col-md-6 col-sm-6",
                            "form"          => '
                                                <div class="mb-1">
                                                    <label class="form-label" for="jam_tutup">Jam Buka<span class="text-danger">*</span></label>
                                                    <input id="jam_tutup" name="jam_tutup" value="'.$data->jam_tutup.'" placeholder="" type="time" class="form-control form-control-sm " required="">
                                                </div>
                                            ' ,
                        ]
                    ]
                ],
            ]
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd(\Auth::user()->getDefaultRole());
        if ($request->ajax()) {
            $data = QueueConfig::latest()->get();
            if(\Auth::user()->getDefaultRole() == 'admin'){
                $data = QueueConfig::where('wilayah', \Auth::user()->wilayah)->latest()->get();
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nama_wilayah', function($row){
                    $wilayah = Wilayah::where('kode_pos', $row->wilayah)->first();
                    if($wilayah){
                        return $wilayah->name;
                    } else {
                        return '-';
                    }
                })
                ->addColumn('action', function($row){
                    $pages = $this->pages($row);

                    $dataLink = [
                        'show' => [
                            'url' => $pages['page']['show']['url'],
                            'label' => "View",
                        ],
                        'edit' => [
                            'url' => $pages['page']['edit']['url'],
                            'label' => "Edit",
                        ],
                        'delete' => [
                            'url'   => $pages['page']['delete'],
                            'id'    => $row->id,
                            'label' => "Delete",
                        ],
                    ];
                    return MenuButtonAction(['show', 'edit', 'delete'], $dataLink);
                })
                ->rawColumns(['nama_wilayah', 'action'])
                ->make(true);
        }

        return view($this->pages()['page']['index']['view'], [
            'pages'             => $this->pages(),
            'tableProperties'   => $this->tableProperties(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pages = $this->pages();

        return view($pages['page']['create']['view'], [
            'pages'         => $pages,
            'pagesSubChild' => [
                'active'    => true,
                'title'     => $pages['page']['create']['title'],
            ],
            'formGenerator' => $this->formGenerateCreate([
                'wilayah'   => $this->QueueConfig->paramsWilayah(),
            ]),
            'params'        => [
                'wilayah'   => $this->QueueConfig->paramsWilayah(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->QueueConfig->doStore($request);

        session()->flash('success', __('Data berhasil disimpan !'));

        return redirect()->to($this->pages()['page']['index']['url']);
    }

    /**
     * Display the specified resource.
     */
    public function show(QueueConfig $queueConfig)
    {
        $pages = $this->pages($queueConfig);

        return view($pages['page']['show']['view'], [
            'pages'         => $pages,
            'pagesSubChild' => [
                'active'    => true,
                'title'     => $pages['page']['show']['title'],
            ],
            'formGenerator' => $this->formGenerateEdit([
                'wilayah'   => $this->QueueConfig->paramsWilayah(),
            ], $queueConfig, true),
            'id'            => $queueConfig->id,
            'params'        => [
                'wilayah'   => $this->QueueConfig->paramsWilayah(),
            ],
            'data'                  => $queueConfig,
            'data_pelayanan_loket'  => json_decode($queueConfig->pelayanan_loket, true),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QueueConfig $queueConfig)
    {
        $pages = $this->pages($queueConfig);

        return view($this->pages()['page']['edit']['view'], [
            'pages'         => $pages,
            'pagesSubChild' => [
                'active'    => true,
                'title'     => $pages['page']['edit']['title'],
            ],
            'formGenerator' => $this->formGenerateEdit([
                'wilayah'   => $this->QueueConfig->paramsWilayah(),
            ], $queueConfig),
            'id'            => $queueConfig->id,
            'params'        => [
                'wilayah'   => $this->QueueConfig->paramsWilayah(),
            ],
            'data'                  => $queueConfig,
            'data_pelayanan_loket'  => json_decode($queueConfig->pelayanan_loket, true),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QueueConfig $queueConfig)
    {
        $data = $this->QueueConfig->doUpdate($request, $queueConfig);

        if($data == true){
            session()->flash('success', __('Data berhasil diubah !'));
            return redirect()->back();
        } else {
            session()->flash('error', __('Data gagal diubah !'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function delete($id)
    {
        $data = $this->QueueConfig->doDelete($id);

        if($data){
            response()->json(['success'=>true]);
        } else {
            response()->json(['success'=>false]);
        }
    }
}
