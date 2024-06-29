<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Menu;
use App\Services\MenuServices;
use App\Http\Requests\MenuRequest;
use DataTables;

class MenuController extends Controller
{
    public function __construct(MenuServices $data)
    {
        $this->menu = $data;
    }

    public static function pages($model = null) {
        $group      = 'admin';
        $main       = 'menu';
        $title      = 'Menu';
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
                    'list'      => [
                        'title' => 'Detail '.$title,
                        'url'   => isset($model->id) ? route($routeGroup.'.show.list', $model->id) : '#',
                        'view'  => $routeGroup.'.show_list',
                    ],
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
                    'className' => 'text-center', 'targets' => '2, 3, 4'
                ]
            ],
            'columns'      =>[
                [
                    'width' => "15%",
                    'label' => __('Icon'),
                    'slug'  => 'icon'
                ],
                [
                    'width' => "17%",
                    'label' => __('Title'),
                    'slug'  => 'title'
                ],
                [
                    'width' => "15%",
                    'label' => __('Route'),
                    'slug'  => 'route'
                ],
                [
                    'width' => "15%",
                    'label' => __('Group'),
                    'slug'  => 'group'
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
        // dd(FormSelect2("Menu Icon", 'icon', "Choose Slug", $params['icon'], false, true));
        return [
            [
                "class"         => "col-md-12 col-sm-12 select2-drpdwn",
                "form"          => FormSelect("Menu Group", 'menu_group_slug', "Choose Menu Groups", $params['menu_group'], true),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "column"        => [
                    "active"    => true,
                    "columns"   => [
                        [
                            "class" => "col-md-8 col-sm-8",
                            "form"  => FormText("Group Route", "group", "Name of Group Route", true),
                        ],
                        [
                            "class" => "col-md-4 col-sm-4",
                            "form"  => "<label class='form-check' style='margin-top:30px;'>
                                            <input class='form-check-input' type='checkbox' name='resources' />
                                            <span class='form-check-label'> ".__('to Resources')." </span>
                                        </label>",
                        ]
                    ]
                ],
            ],
            [
                "class"         => "col-md-8 col-sm-8",
                "form"          => FormSelect2("Menu Icon", 'icon', "Choose Slug", $params['icon'], false, true),
            ],
            [
                "class"         => "col-md-4 col-sm-4",
                "form"          => "<div id='icon-preview'></div>",
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormText("Menu Title", "title", "Menu Title", true),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormText("Name Route", "route", "Name in Route Web/Admin", true),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormSelect("Permission", 'permessions', "Choose Permission", $params['permission'], true),
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
                "class"         => "col-md-12 col-sm-12 select2-drpdwn",
                "form"          => FormSelect("Menu Group", 'menu_group_slug', "Choose Menu Groups", $params['menu_group'], true, $data->menu_group_slug, $readonly),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "column"        => [
                    "active"    => true,
                    "columns"   => [
                        [
                            "class" => "col-md-10 col-sm-10",
                            "form"  => FormText("Group Route", "group", "Name of Group Route", true, $data->group, $readonly),
                        ],
                        [
                            "class" => "col-md-2 col-sm-2",
                            "form"  => "<label class='form-check pt-4'>
                                            <input class='form-check-input' type='checkbox' ".$checked." name='is_active' />
                                            <span class='form-check-label'> Active </span>
                                        </label>",
                        ]
                    ]
                ],
            ],
            [
                "class"         => "col-md-10 col-sm-10",
                "form"          => FormSelect2("Menu Icon", 'icon', "Choose Slug", $params['icon'], false, true, $data->icon, $readonly),
            ],
            [
                "class"         => "col-md-2 col-sm-2",
                "form"          => '<div id="icon-preview"><i class="font-preview icofont '.$data->icon.'"></i></div>',
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormText("Menu Title", "title", "Menu Title", true, $data->title, $readonly),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormText("Name Route", "route", "Name in Route Web/Admin", true, $data->route, $readonly),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormSelect("Permission", 'permessions', "Choose Permission", $params['permission'], true, $data->permessions),
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
            $data = Menu::whereIsActive(true)->whereRaw("route LIKE '%.index'")->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('icon', function($row){
                    return '<i class="icofont '.$row->icon.'"></i> &nbsp; '.$row->icon;
                })
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
                    return MenuButtonAction(['show'], $dataLink);
                })
                ->rawColumns(['icon','status', 'action'])
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
                'menu_group'    => $this->menu->paramsGroup(false),
                'permission'    => $this->menu->paramsPermission(),
                'icon'          => $this->menu->paramsIcon(),
                'role'          => $this->menu->paramsRole(),
            ]),
            'params'        => [
                'role'          => $this->menu->paramsRole(),
                'type_data'     => $this->menu->paramsTypeData(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $this->menu->doStore($request);

        session()->flash('success', __('Data berhasil disimpan !'));

        return redirect()->to($this->pages()['page']['index']['url']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $pages = $this->pages($menu);
        $mainMenu = Menu::whereGroup($menu->group)->whereIsActive(true)->whereRaw("route LIKE '%.index'")->first();

        return view($this->pages()['page']['edit']['view'], [
            'pages'         => $pages,
            'pagesSubChild' => [
                'active'    => true,
                'title'     => $pages['page']['edit']['title'],
            ],
            'formGenerator' => $this->formGenerateEdit([
                'menu_group'    => $this->menu->paramsGroup(false),
                'permission'    => $this->menu->paramsPermission(),
                'icon'          => $this->menu->paramsIcon(),
            ], $menu),
            'optionSelect'  => TextToArray($menu->menus),
            'id'            => $menu->id,
            'listMenu'     => $this->menu->listMenu($menu->group),
            'routeBack'     => route('admin.menu.show', $mainMenu->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $data = $this->menu->doUpdate($request, $menu);

        if($data == true){
            session()->flash('success', __('Data berhasil diubah !'));
            return redirect()->back();
        } else {
            session()->flash('error', __('Data gagal diubah !'));
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $data = $this->menu->doDelete($id);

        if($data){
            response()->json(['success'=>true]);
        } else {
            response()->json(['success'=>false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function destroy($id)
    {
        return '';
    }
    */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Menu $menu)
    {
        $pages = $this->pages($menu);

        return view($pages['page']['show']['view'], [
            'pages'         => $pages,
            'pagesSubChild' => [
                'active'    => true,
                'title'     => $pages['page']['show']['title'],
            ],
            'formGenerator' => $this->formGenerateEdit([
                'menu_group'    => $this->menu->paramsGroup(false),
                'permission'    => $this->menu->paramsPermission(),
                'icon'          => $this->menu->paramsIcon(),
            ], $menu, true),
            'optionSelect'  => TextToArray($menu->menus),
            'id'            => $menu->id,
            'listMenu'     => $this->menu->listMenu($menu->group),
        ]);
    }

    public function showList(Menu $menu)
    {
        $pages = $this->pages($menu);
        $mainMenu = Menu::whereGroup($menu->group)->whereIsActive(true)->whereRaw("route LIKE '%.index'")->first();
        
        return view($pages['page']['show']['list']['view'], [
            'pages'         => $pages,
            'pagesSubChild' => [
                'active'    => true,
                'title'     => $pages['page']['show']['list']['title'],
            ],
            'formGenerator' => $this->formGenerateEdit([
                'menu_group'    => $this->menu->paramsGroup(false),
                'permission'    => $this->menu->paramsPermission(),
                'icon'          => $this->menu->paramsIcon(),
            ], $menu, true),
            'optionSelect'  => TextToArray($menu->menus),
            'id'            => $menu->id,
            'routeBack'     => route('admin.menu.show', $mainMenu->id),
        ]);
    }
}
