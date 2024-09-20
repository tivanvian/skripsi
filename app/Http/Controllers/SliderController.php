<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Slider;
use App\Services\SliderServices;
use App\Http\Requests\SliderRequest;
use DataTables;


class SliderController extends Controller
{
    public function __construct(SliderServices $data)
    {
        $this->Slider = $data;
    }

    public static function pages($model = null) {
        $group      = 'admin';
        $main       = 'slider';
        $title      = 'Slider';
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
                    'className' => 'text-center', 'targets' => '1,2'
                ]
            ],
            'columns'      =>[
                [
                    'width' => "15%",
                    'label' => __('Wilayah'),
                    'slug'  => 'wilayah'
                ],
                [
                    'width' => "68%",
                    'label' => __('Nama'),
                    'slug'  => 'name'
                ],
                [
                    'width' => "10%",
                    'label' => __('Active'),
                    'slug'  => 'is_active'
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
                "form"          => FormSelect2("Nama Wilayah", 'wilayah', "Choose Wilayah", $params['wilayah'], false, true),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormText("Nama Slider", "name", "name", true),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => "
                                    <div class=\"mb-1\">
                                        <label class=\"form-label\" for=\"name\">Foto/VIdeo Slider<span class=\"text-danger\">*</span></label>
                                        <input name=\"slider_file\" id=\"slider_file\" type=\"file\" class=\"form-control form-control-sm\" required=\"\">
                                    </div>
                                    "
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
                            "class"         => "col-md-9 col-sm-8",
                            "form"          => FormSelect2("Nama Wilayah", 'wilayah', "Pilih Wilayah", $params['wilayah'], false, true, $data->wilayah, $readonly),
                        ],
                        [
                            "class" => "col-md-3 col-sm-4",
                            "form"  => "<label class='form-check pt-4'>
                                            <input class='form-check-input' type='checkbox' ".$checked." name='is_active' />
                                            <span class='form-check-label'> Aktif </span>
                                        </label>",
                        ]
                    ]
                ],
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormText("Nama Slider", "name", "name", true, $data->name, $readonly),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => "
                                    <div class=\"mb-4\">
                                        <label class=\"form-label\" for=\"name\">Foto/VIdeo Slider</label>
                                        <input name=\"slider_file\" id=\"slider_file\" type=\"file\" class=\"form-control form-control-sm\">
                                    </div>
                                    "
            ],
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Slider::all();
            if(\Auth::user()->getDefaultRole() == 'admin'){
                $data = Slider::where('wilayah', \Auth::user()->wilayah)->latest()->get();
            }
            return DataTables::of($data)
                ->addIndexColumn()
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
                    return ButtonAction(['update', 'delete', 'show'], $dataLink);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view($this->pages()['page']['index']['view'], [
            'pages'             => $this->pages(),
            'tableProperties'   => $this->tableProperties(),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
                'wilayah'   => $this->Slider->paramsWilayah(),
            ]),
            'params'        => [
                'wilayah'   => $this->Slider->paramsWilayah(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->Slider->doStore($request);
        if($data) {
            session()->flash('success', 'Data berhasil disimpan!');
        } else {
            session()->flash('error', 'Data gagal disimpan!');
        }

        return redirect()->to($this->pages()['page']['index']['url']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $Slider)
    {
        $pages = $this->pages($Slider);

        return view($pages['page']['show']['view'], [
            'pages'         => $pages,
            'pagesSubChild' => [
                'active'    => true,
                'title'     => $pages['page']['edit']['title'],
            ],
            'formGenerator' => $this->formGenerateEdit([
                'wilayah'   => $this->Slider->paramsWilayah(),
            ], $Slider, true),
            'id'            => $Slider->id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Data = $this->Slider->findBy('id', $id);

        $pages = $this->pages($Data);

        return view($this->pages()['page']['edit']['view'], [
            'pages'         => $pages,
            'pagesSubChild' => [
                'active'    => true,
                'title'     => $pages['page']['edit']['title'],
            ],
            'formGenerator' => $this->formGenerateEdit([
                'wilayah'   => $this->Slider->paramsWilayah(),
            ], $Data),
            'id'            => $Data->id,
            'data'          => $Data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Data = $this->Slider->findBy('id', $id);

        $data = $this->Slider->doUpdate($request, $Data);

        if($data == true){
            session()->flash('success', 'Data berhasil diubah !');
            return redirect()->back();
        } else {
            session()->flash('error', 'Data gagal diubah !');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return '';
    }

    public function delete($id)
    {
        $data = $this->Slider->doDelete($id);

        if($data){
            response()->json(['success'=>true]);
        } else {
            response()->json(['success'=>false]);
        }
    }
}
