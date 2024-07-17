<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Wilayah;
use App\Services\WilayahServices;
use App\Http\Requests\WilayahRequest;
use DataTables;


class WilayahController extends Controller
{
    public function __construct(WilayahServices $data)
    {
        $this->Wilayah = $data;
    }

    public static function pages($model = null) {
        $group      = 'admin';
        $main       = 'wilayah';
        $title      = 'Wilayah';
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
                    'label' => __('Kode Wilayah'),
                    'slug'  => 'code'
                ],
                [
                    'width' => "10%",
                    'label' => __('Kode Pos'),
                    'slug'  => 'kode_pos'
                ],
                [
                    'width' => "33%",
                    'label' => __('Kota'),
                    'slug'  => 'city'
                ],
                [
                    'width' => "30%",
                    'label' => __('Nama Wilayah'),
                    'slug'  => 'name'
                ],
                [
                    'width' => "10%",
                    'label' => __('Active'),
                    'slug'  => 'status'
                ],
                [
                    'width' => "7%",
                    'label' => __('Action'),
                    'slug'  => 'action'
                ],
            ],
        ];
    }


    public static function formGenerateCreate($params = []){
        return [
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormText("Kode Wilayah", "code", "code", true),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormText("Nama Wilayah", "name", "name", true),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => '<div class="mb-3">
										<label class="form-label" for="username">Alamat</label>
										<textarea class="form-control" name="detail[address]" id="detail.address" rows="3">'.old("detail.address").'</textarea>
									</div>',
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormText("Kode Pos", "kode_pos", "Postal Code", true),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormText("Latitude", "latitude", "latitude", true),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormText("Longitude", "longitude", "longitude", true),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormSelect("Kota", 'city', "Pilih Kota", $params['city'], true),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormSelect("Level Wilayah", 'level', "Pilih Level", $params['level'], true),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormText("Telepon", "detail[telphone]", "Telepon", true),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormText("Email", "detail[email]", "Email", true),
            ],
        ];
    }

    public static function formGenerateEdit($params = [], $data, $readonly = false){
        //Check Active
        if($data->is_active == true){
            $checked = 'checked';
        }else{
            $checked = '';
        }
        
        return [
            [
                "class"         => "col-md-12 col-sm-12",
                "column"        => [
                    "active"    => true,
                    "columns"   => [
                        [
                            "class" => "col-md-9 col-sm-8",
                            "form"  => FormText("Kode Wilayah", "code", "code", true, $data->code, $readonly) ,
                        ],
                        [
                            "class" => "col-md-3 col-sm-4",
                            "form"  => "<label class='form-check pt-4'>
                                            <input class='form-check-input' type='checkbox' ".$checked." name='is_active' />
                                            <span class='form-check-label'> Aktif </span>
                                        </label>",
                        ],
                        [
                            "class"         => "col-md-12 col-sm-12",
                            "form"          => FormText("Nama Wilayah", "name", "name", true, $data->name, $readonly),
                        ],
                        [
                            "class"         => "col-md-12 col-sm-12",
                            "form"          => '<div class="mb-3">
                                                    <label class="form-label" for="username">Alamat</label>
                                                    <textarea class="form-control" name="detail[address]" id="detail.address" rows="3">'.RenderJson($data->detail, "address").'</textarea>
                                                </div>',
                        ],
                        [
                            "class"         => "col-md-12 col-sm-12",
                            "form"          => FormText("Kode Pos", "kode_pos", "Postal Code", true, $data->kode_pos, $readonly),
                        ],
                        [
                            "class"         => "col-md-12 col-sm-12",
                            "form"          => FormText("Latitude", "latitude", "latitude", true, $data->latitude, $readonly),
                        ],
                        [
                            "class"         => "col-md-12 col-sm-12",
                            "form"          => FormText("Longitude", "longitude", "longitude", true, $data->longitude, $readonly),
                        ],
                        [
                            "class"         => "col-md-12 col-sm-12",
                            "form"          => FormSelect("Kota", 'city', "Pilih Kota", $params['city'], true, $data->city),
                        ],
                        [
                            "class"         => "col-md-12 col-sm-12",
                            "form"          => FormSelect("Level Wilayah", 'level', "Pilih Level", $params['level'], true, $data->level),
                        ],
                        [
                            "class"         => "col-md-12 col-sm-12",
                            "form"          => FormText("Telepon", "detail[telphone]", "Telepon", true, RenderJson($data->detail, "telphone"), $readonly),
                        ],
                        [
                            "class"         => "col-md-12 col-sm-12",
                            "form"          => FormText("Email", "detail[email]", "Email", true, RenderJson($data->detail, "email"), $readonly),
                        ],
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
        if ($request->ajax()) {
            $data = Wilayah::whereIsActive(true)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    return Status($row->is_active);
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
                ->rawColumns(['status', 'action'])
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
                'city'          => $this->Wilayah->paramsCity(),
                'level'         => $this->Wilayah->paramsLevelRegion(),
            ]),
            'params'        => [
                'city'          => $this->Wilayah->paramsCity(),
                'level'         => $this->Wilayah->paramsLevelRegion(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WilayahRequest $request)
    {
        $this->Wilayah->doStore($request);

        session()->flash('success', __('Data berhasil disimpan !'));

        return redirect()->to($this->pages()['page']['index']['url']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Wilayah $wilayah)
    {
        $pages = $this->pages($wilayah);

        return view($pages['page']['show']['view'], [
            'pages'         => $pages,
            'pagesSubChild' => [
                'active'    => true,
                'title'     => $pages['page']['show']['title'],
            ],
            'formGenerator' => $this->formGenerateEdit([
                'city'          => $this->Wilayah->paramsCity(),
                'level'         => $this->Wilayah->paramsLevelRegion(),
            ], $wilayah, true),
            'id'            => $wilayah->id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wilayah $wilayah)
    {
        $pages = $this->pages($wilayah);

        return view($this->pages()['page']['edit']['view'], [
            'pages'         => $pages,
            'pagesSubChild' => [
                'active'    => true,
                'title'     => $pages['page']['edit']['title'],
            ],
            'formGenerator' => $this->formGenerateEdit([
                'city'          => $this->Wilayah->paramsCity(),
                'level'         => $this->Wilayah->paramsLevelRegion(),
            ], $wilayah),
            'id'            => $wilayah->id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wilayah $wilayah)
    {
        $data = $this->Wilayah->doUpdate($request, $wilayah);

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
        $data = $this->Wilayah->doDelete($id);

        if($data){
            response()->json(['success'=>true]);
        } else {
            response()->json(['success'=>false]);
        }
    }
}
