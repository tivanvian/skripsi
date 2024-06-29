<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;
use App\Services\UserServices;
use App\Http\Requests\UserRequest;
use DataTables;
use Storage;

class UserController extends Controller
{
    private $userData;
    
    public function __construct(UserServices $data)
    {
        $this->userData = $data;
    }

    public static function pages($model = null) {
        $group      = 'admin';
        $main       = 'user';
        $title      = 'User';
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
                    'className' => 'text-center', 'targets' => '0, 2, 3'
                ]
            ],
            'columns'      =>[
                [
                    'width' => "10%",
                    'label' => __(''),
                    'slug'  => 'avatar'
                ],
                [
                    'width' => "33%",
                    'label' => __('Name'),
                    'slug'  => 'name'
                ],
                [
                    'width' => "15%",
                    'label' => __('Role'),
                    'slug'  => 'role'
                ],
                [
                    'width' => "25%",
                    'label' => __('Email'),
                    'slug'  => 'email'
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
                "form"          => FormText("Name", "name", "Fullname", true),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormText("Email", "email", "email@email.com", true),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "column"        => [
                    "active"    => true,
                    "columns"   => [
                        [
                            "class" => "col-md-6 col-sm-12",
                            "form"  => FormText("Password", "password", "******", true)  ,
                        ],
                        [
                            "class" => "col-md-6 col-sm-12",
                            "form"  => FormText("Password Confirmation", "password_confirmation", "*****", true) ,
                        ],
                    ]
                ],
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormSelect("Role", 'default_role', "-- Chose Role --", $params['roles']),
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

        //Check is_confirmed
        if($data->is_confirmed == true){
            $confirmed = 'checked';
        }else{
            $confirmed = '';
        }

        return [
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormText("Email", "email", "email@email.com", true, $data->email, $readonly),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormSelect("Default Role", 'default_role', "-- Chose Role --", $params['roles'], true, $data->getDefaultRole(), $readonly),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormSelect2("User Roles", 'user_role', "-- Select Role --", $params['multipleRole'], true, true, $data->dataRole, $readonly),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormText("Password", "password", "******", false, '', $readonly),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "form"          => FormText("Password Confirmation", "password_confirmation", "*****", false, '', $readonly),
            ],
            [
                "class"         => "col-md-12 col-sm-12",
                "column"        => [
                    "active"    => true,
                    "columns"   => [
                        [
                            "class" => "col-md-6 col-sm-6",
                            "form"  => "<label class='form-check pt-4'>
                                            <input class='form-check-input' type='checkbox' ".$confirmed." name='is_confirmed' />
                                            <span class='form-check-label'> Confirmed </span>
                                        </label>" ,
                        ],
                        [
                            "class" => "col-md-6 col-sm-6",
                            "form"  => "<label class='form-check pt-4'>
                                            <input class='form-check-input' type='checkbox' ".$checked." name='is_active' />
                                            <span class='form-check-label'> Active </span>
                                        </label>",
                        ]
                    ]
                ],
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
            $data = User::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('avatar', function($row){
                    $pic = ($row->UserPhoto() != null || $row->UserPhoto() != '') ? Storage::url("profile/".$row->UserPhoto()) : asset("backend/assets/imgs/people/avatar-2.png");
                    // $class='<a href="'.route($this->pages()['page']['show']['url'], $row).'" class="itemside">
                    $class='<a href="#" class="itemside">
                                <div class="left">
                                    <div class="social-img-wrap">
                                        <div class="social-img"><img src="'.$pic.'" alt="profile"></div>
                                    </div>
                                </div>
                            </a>';

                    return $class;
                })
                ->addColumn('status', function($row){
                    return Status($row->is_active);
                })
                ->addColumn('role', function($row){
                    return $row->getDefaultRole();
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
                ->rawColumns(['avatar','status', 'action', 'role'])
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
            'pages'         => $this->pages(),
            'pagesSubChild' => [
                'active'    => true,
                'title'     => $pages['page']['create']['title'],
            ],
            'formGenerator' => $this->formGenerateCreate([
                'roles'     => $this->userData->paramsRole(),
            ]),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->userData->doStore($request);

        session()->flash('success', 'Data berhasil disimpan !');

        return redirect()->to($this->pages()['page']['index']['url']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $pages = $this->pages($user);

        $pic = ($user->UserPhoto() != null || $user->UserPhoto() != '') ? Storage::url("profile/".$user->UserPhoto()) : asset("backend/assets/imgs/people/avatar-2.png");
        // return view($pages['page']['show']['view'], [
        //     'pages'         => $pages,
        //     'pagesSubChild' => [
        //         'active'    => true,
        //         'title'     => $this->pages()['page']['show']['title'],
        //     ],
        //     'data'  => $user
        // ]);
        // dd($pages);
        return view($pages['page']['show']['view'], [
            'pages'         => $pages,
            'pagesSubChild' => [
                'active'    => true,
                'title'     => $pages['page']['edit']['title'],
            ],
            'data'          => $user,
            'picture'       => $pic,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // return view($this->pages()['folder'].'.edit', [
        //     'pages'         => $this->pages(),
        //     'data'          => $user,
        //     // 'profile'       => $user->UserProfileData()->first(),
        //     'dataRole'      => $this->userData->dataUserRoles($user),
        //     'multipleRole'  => $this->userData->paramsRole(),
        //     'roles'         => $this->userData->paramsRole(false),
        //     'genders'       => $this->userData->paramsGender(),
        //     // 'regions'       => $this->userData->paramsRegion(),
        // ]);

        $pages = $this->pages($user);

        $user->dataRole = $this->userData->dataUserRoles($user);

        return view($pages['page']['edit']['view'], [
            'pages'         => $pages,
            'pagesSubChild' => [
                'active'    => true,
                'title'     => $pages['page']['edit']['title'],
            ],
            'formGenerator' => $this->formGenerateEdit([
                'roles'         => $this->userData->paramsRole(),
                'multipleRole'  => $this->userData->paramsRole(false),
                'genders'       => $this->userData->paramsGender(),
            ], $user),
            'optionSelect'  => TextToArray($this->userData->dataUserRoles($user)),
            'data'          => $user,
            'id'            => $user->id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $this->userData->doUpdate($request, $user);

        if($data == true){
            session()->flash('success', 'Data berhasil diubah !');
            return redirect()->back();
            // return redirect()->route($this->pages()['page']['index']['url']);
        } else {
            session()->flash('error', 'Data gagal diubah !');
            return redirect()->back();
            // return redirect()->route($this->pages()['page']['index']['url']);
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
        $data = $this->userData->doDelete($id);

        if($data){
            response()->json(['success'=>true]);
        } else {
            response()->json(['success'=>false]);
        }
    }

    public function ChangeSessionRole(Request $request){
        if(session()->has('default_role')){
            session()->forget('default_role');
        }

        session()->put('default_role', $request->session_roles);

        //Check Default Role from Role
        $default_route = Role::where('slug', $request->session_roles)->first()->default_route;

        return response()->json(['success'=>true, 'route' => route($default_route)]);
    }
}
