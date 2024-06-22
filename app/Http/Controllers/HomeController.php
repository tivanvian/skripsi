<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     // $this->middleware('auth');
    // }

    public static function pages() {
        $group      = 'admin';
        $main       = 'aindex';
        $title      = 'Dashboard';
        $routeGroup = $group.'.'.$main;

        return [
            'title-bar'         => $title,
            'page'              => [
                'home'          => $group.'.aindex',
                'breadcrumb'    => [
                    'parent'    => 'Dashboard',
                    'child'     => ['title' => $title, 'url' => $routeGroup],
                    // 'subChild'  => 'subChild',
                ],
                'index'         => [
                    'title'     => $title,
                    'url'       => $routeGroup,
                    'view'      => $group.'.home_v2',
                ],
                'create'        => [
                    'title'     => $routeGroup.'.create.title',
                    'url'       => $routeGroup.'.create',
                    'store'     => $routeGroup.'.store',
                ],
                'show'          => [
                    'title'     => $routeGroup.'.show.title',
                    'url'       => $routeGroup.'.show',
                ],
                'edit'          => [
                    'title'     => $routeGroup.'.edit.title',
                    'url'       => $routeGroup.'.edit',
                    'update'    => $routeGroup.'.update',
                ],
                'destroy'       => $routeGroup.'.destroy',
                'delete'        => $routeGroup.'.delete',
            ],
        ];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Set Default Localization
        // dd(\Config::get('languages')[\App::getLocale()]);
        if(session('locale') == null || session('locale') == ''){
            App::setLocale('id');
            session()->put('locale', 'id');
            session()->put('applocale', 'id');
        }

        return view('welcome');
    }

    public function changeLang(Request $request)
    {
        if (array_key_exists($request->lang, \Config::get('languages'))) {
            \Session::put('locale', $request->lang);
            \Session::put('applocale', $request->lang);
        }

        return redirect()->back();
    }


    // public function adminHome()
    // {
    //     return view('admin.home');
    // }

    public function adminHome()
    {
        // dd('oke');
        return view($this->pages()['page']['index']['view'], [
            'pages' => $this->pages(),
        ]);
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    // public function backend()
    // {
    //     return view('layouts.__backend.app');
    // }
}
