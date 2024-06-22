<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Parameter;
use App\Services\ParameterServices;
use App\Http\Requests\ParameterRequest;
use DataTables;


class ParameterController extends Controller
{
    public function __construct(ParameterServices $data)
    {
        $this->Params = $data;
    }

    public static function pages($model = null) {
        $group      = 'admin';
        $main       = 'parameter';
        $title      = 'Parameters';
        $routeGroup = $group.'.'.$main;

        return [
            'title-bar'         => $title,
            'page'              => [
                'home'          => $group.'.aindex',
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
                    'width' => "30%",
                    'label' => __('Slug'),
                    'slug'  => 'slug'
                ],
                [
                    'width' => "53%",
                    'label' => __('Nama'),
                    'slug'  => 'nama'
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
                "form"          => FormText("Slug", "slug", "slug", true),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormText("Nama", "nama", "nama", true),
            ]
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
                            "form"  => FormText("Slug", "slug", "slug", true, $data->slug, $readonly) ,
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
                "form"          => FormText("Nama", "nama", "nama", true, $data->nama, $readonly),
            ]
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
            $data = Parameter::all();
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
                    return ButtonAction(['update', 'delete', 'show'], $dataLink);
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
            'formGenerator' => $this->formGenerateCreate([]),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParameterRequest $request)
    {
        $this->Params->doStore($request);

        session()->flash('success', 'Data berhasil disimpan !');

        return redirect()->to($this->pages()['page']['index']['url']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Parameter $Parameter)
    {
        $pages = $this->pages($Parameter);

        return view($pages['page']['show']['view'], [
            'pages'         => $pages,
            'pagesSubChild' => [
                'active'    => true,
                'title'     => $pages['page']['edit']['title'],
            ],
            'formGenerator' => $this->formGenerateEdit([], $Parameter, true),
            'id'            => $Parameter->id,
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
        $Params = $this->Params->findBy('id', $id);

        $pages = $this->pages($Params);

        return view($this->pages()['page']['edit']['view'], [
            'pages'         => $pages,
            'pagesSubChild' => [
                'active'    => true,
                'title'     => $pages['page']['edit']['title'],
            ],
            'formGenerator' => $this->formGenerateEdit([], $Params),
            'id'            => $Params->id,
            'data'          => $Params,
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
        $Params = $this->Params->findBy('id', $id);

        $data = $this->Params->doUpdate($request, $Params);

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
        $data = $this->Params->doDelete($id);

        if($data){
            response()->json(['success'=>true]);
        } else {
            response()->json(['success'=>false]);
        }
    }
}
