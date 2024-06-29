<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MenuGroup;
use App\Services\MenuGroupServices;
use App\Http\Requests\MenuGroupRequest;
use DataTables;

class MenuGroupController extends Controller
{
    public function __construct(MenuGroupServices $data)
    {
        $this->MenuGroup = $data;
    }

    public static function pages($model = null) {
        $group      = 'admin';
        $main       = 'menu-group';
        $title      = 'Menu Group';
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
                    'width' => "30%",
                    'label' => __('Name'),
                    'slug'  => 'name'
                ],
                [
                    'width' => "33%",
                    'label' => __('Description'),
                    'slug'  => 'description'
                ],
                [
                    'width' => "20%",
                    'label' => __('Order'),
                    'slug'  => 'order'
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
                "form"          => FormText("Name Group", "name", "name group", true),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormText("Description Group", "description", "description group", true),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormText("Order", "order", "order", true),
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
                            "form"  => FormText("Name Group", "name", "name group", true, $data->name, $readonly) ,
                        ],
                        [
                            "class" => "col-md-3 col-sm-4",
                            "form"  => "<label class='form-check pt-4'>
                                            <input class='form-check-input' type='checkbox' ".$checked." name='is_active' />
                                            <span class='form-check-label'> Active </span>
                                        </label>",
                        ]
                    ]
                ],
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormText("Description Group", "description", "description group", true, $data->description, $readonly),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormText("Order", "order", "order", true, $data->order, $readonly),
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
        // dd($data = MenuGroup::all());
        if ($request->ajax()) {
            $data = MenuGroup::all();
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
    public function store(MenuGroupRequest $request)
    {
        $this->MenuGroup->doStore($request);

        session()->flash('success', 'Data berhasil disimpan !');

        return redirect()->to($this->pages()['page']['index']['url']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MenuGroup $MenuGroup)
    {
        $pages = $this->pages($MenuGroup);

        return view($pages['page']['show']['view'], [
            'pages'         => $pages,
            'pagesSubChild' => [
                'active'    => true,
                'title'     => $pages['page']['edit']['title'],
            ],
            'formGenerator' => $this->formGenerateEdit([], $MenuGroup, true),
            'optionSelect'  => TextToArray($MenuGroup->menus),
            'id'            => $MenuGroup->id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuGroup $MenuGroup)
    {
        $pages = $this->pages($MenuGroup);

        return view($this->pages()['page']['edit']['view'], [
            'pages'         => $pages,
            'pagesSubChild' => [
                'active'    => true,
                'title'     => $pages['page']['edit']['title'],
            ],
            'formGenerator' => $this->formGenerateEdit([], $MenuGroup),
            'optionSelect'  => TextToArray($MenuGroup->menus),
            'id'            => $MenuGroup->id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuGroup $MenuGroup)
    {
        $data = $this->MenuGroup->doUpdate($request, $MenuGroup);

        if($data == true){
            session()->flash('success', 'Data berhasil diubah !');
            return redirect()->to($this->pages()['page']['index']['url']);
        } else {
            session()->flash('error', 'Data gagal diubah !');
            return redirect()->to($this->pages()['page']['index']['url']);
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
        $data = $this->MenuGroup->doDelete($id);

        if($data){
            response()->json(['success'=>true]);
        } else {
            response()->json(['success'=>false]);
        }
    }
}
