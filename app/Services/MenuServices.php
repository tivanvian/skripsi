<?php
/* OKE */
namespace App\Services;

use App\Models\Menu;
use App\Models\MenuGroup;
use App\Models\Role;
use App\Models\RoleMenu;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use DataTables;

class MenuServices
{
    public $mainClass = Menu::class;

    public function main()
    {
        return $this->mainClass->whereIsActive('t')->get();
    }

    public function findBy($field, $id)
    {
        return $this->mainClass->whereActive('t')->where($field, $id)->first();
    }

    public function paramsPermission()
    {
        return [
            [
                'id' => 'create',
                'name' => 'Create'
            ],
            [
                'id' => 'read',
                'name' => 'Read'
            ],
            [
                'id' => 'update',
                'name' => 'Update'
            ],
            [
                'id' => 'delete',
                'name' => 'Delete'
            ]
        ];
    }

    public function paramsIcon()
    {
        $jsonFilePath = public_path('themes/assets/json/icofont-v2.json');
        $jsonData = json_decode(file_get_contents($jsonFilePath), true);
        return $jsonData;
    }

    public function paramsMenu($multiple = true){
        if($multiple){
            return Menu::select(['group as id', 'title as name'])->whereRaw("route ilike '%.index'")->get()->toArray();
        } else {
            return Menu::select(['route as id', 'title as name'])->whereRaw("route ilike '%.index'")->get()->toArray();
        }
    }

    public function paramsGroup($multiple = true){
        if($multiple){
            return MenuGroup::select(['slug as id', 'name'])->get()->toArray();
        } else {
            return MenuGroup::select(['slug as id', 'name'])->get()->toArray();
        }
    }

    public function paramsRole($multiple = true){
        return Role::select(['id', 'name'])->get()->toArray();
    }

    public function paramsTypeData()
    {
        return [
            [
                'id' => 'primary_uuid',
                'name' => 'Primary UUID'
            ],
            [
                'id' => 'uuid',
                'name' => 'UUID'
            ],
            [
                'id' => 'string',
                'name' => 'String'
            ],
            [
                'id' => 'integer',
                'name' => 'Integer'
            ],
            [
                'id' => 'text',
                'name' => 'Text'
            ],
            [
                'id' => 'boolean',
                'name' => 'Boolean'
            ],
            [
                'id' => 'date',
                'name' => 'Date'
            ],
            [
                'id' => 'datetime',
                'name' => 'Datetime'
            ],
            [
                'id' => 'time',
                'name' => 'Time'
            ],
            [
                'id' => 'timestamp',
                'name' => 'Timestamp'
            ],
            [
                'id' => 'decimal',
                'name' => 'Decimal'
            ],
            [
                'id' => 'float',
                'name' => 'Float'
            ],
            [
                'id' => 'double',
                'name' => 'Double'
            ],
            [
                'id' => 'enum',
                'name' => 'Enum'
            ],
            [
                'id' => 'json',
                'name' => 'Json'
            ],
            [
                'id' => 'jsonb',
                'name' => 'Jsonb'
            ],
        ];
    }

    public function routeResources($icon, $title, $group, $group_slug){
        return [
            [
                'type'          => 'main',
                'icon'          => $icon,
                'title'         => $title.' Create',
                'route'         => 'admin.'.$group.'.create',
                'group'         => $group,
                'is_active'     => 't',
                'permessions'   => 'create',
                'menu_group_slug'    => $group_slug
            ],
            [
                'type'          => 'main',
                'icon'          => $icon,
                'title'         => $title.' Show',
                'route'         => 'admin.'.$group.'.show',
                'group'         => $group,
                'is_active'     => 't',
                'permessions'   => 'read',
                'menu_group_slug'    => $group_slug
            ],
            [
                'type'          => 'main',
                'icon'          => $icon,
                'title'         => $title.' Edit',
                'route'         => 'admin.'.$group.'.edit',
                'group'         => $group,
                'is_active'     => 't',
                'permessions'   => 'update',
                'menu_group_slug'    => $group_slug
            ],
            [
                'type'          => 'main',
                'icon'          => $icon,
                'title'         => $title.' Store',
                'route'         => 'admin.'.$group.'.store',
                'group'         => $group,
                'is_active'     => 't',
                'permessions'   => 'create',
                'menu_group_slug'    => $group_slug
            ],
            [
                'type'          => 'main',
                'icon'          => $icon,
                'title'         => $title.' Update',
                'route'         => 'admin.'.$group.'.update',
                'group'         => $group,
                'is_active'     => 't',
                'permessions'   => 'update',
                'menu_group_slug'    => $group_slug
            ],
            [
                'type'          => 'main',
                'icon'          => $icon,
                'title'         => $title.' Delete',
                'route'         => 'admin.'.$group.'.delete',
                'group'         => $group,
                'is_active'     => 't',
                'permessions'   => 'delete',
                'menu_group_slug'    => $group_slug
            ]
        ];
    }

    public function doStore($request) {

        if($request['resources']) {
            //if resources is true
            $data = $this->routeResources($request['icon'], $request['title'], $request['group'], $request['menu_group_slug']);

            foreach ($data as $key => $value) {
                $this->mainClass::create($value);
            }

            //to insert Menu
            $data = $this->mainClass::create($request->all());

            //to create route in web.php
            $routeCreate = $this->editAdminRoute($request);

            //to Assign Role
            $roleMenuCreate = $this->toAssignRole($request);

            return $data;
        } else {
            //if resources is false
            return $this->mainClass::create($request->all());

        }
    }

    public function doUpdate($request, $menu) {
        // //Update to Datapase
        if($request['is_active']) {
            $request['is_active'] = true;
        } else {
            $request['is_active'] = false;
        }

        $menu->update($request->all());

        return true;
    }

    public function doDelete($menu) {
        $menu = $this->mainClass::findOrFail($menu);
        $menu->delete();
        return true;
    }

    public function toAssignRole($request)
    {
        $data = [];

        foreach ($request->role_access as $key => $value) {
            $data = [
                'role_id'       => $value['role'],
                'role_slug'     => getSlugRole($value['role']),
                'menu_group'    => $request->group,
                'access'        => $value['access'],
            ];

            RoleMenu::create($data);
        }

        return $data;
    }

    //Aditional Function
    public function editAdminRoute($request = null)
    {
        //artsan make controller -r
        if(isset($request["controller"]) && isset($request["model"]) && isset($request["request"]) && isset($request["service"]) && !empty($request["controller"]) && !empty($request["model"]) && !empty($request["request"]) && !empty($request["service"])){
            Artisan::call('make:controller', [
                'name'          => $request["controller"],
                '--resource'    => true,
            ]);

            //Edit Controller
            $fileController = app_path('Http/Controllers/'.$request["controller"].'.php');
            $controllerFile = file_get_contents($fileController);
            $controller = str_replace("use Illuminate\Http\Request;","use Illuminate\Http\Request;\n\nuse App\Models\\".$request["model"].";\nuse App\Services\\".$request["service"].";\nuse App\Http\Requests\\".$request["request"].";\nuse DataTables;\n",$controllerFile);

            //Index
            $controller = str_replace("class ".$request["controller"]." extends Controller\n{","class ".$request["controller"]." extends Controller\n{\n    public function __construct(".$request['service']." $".""."data)\n    {\n        $".""."this->".$request['model']." = $".""."data;\n    }\n",$controller);

            //Save
            file_put_contents($fileController, $controller);
        }


        // artisan make model
        if(isset($request["model"]) && !empty($request["model"])){
            Artisan::call('make:model', [
                'name'          => $request["model"],
            ]);
        }


        // artisan call make service
        if(isset($request["service"]) && !empty($request["service"])){
            Artisan::call('make:service', [
                'name'          => $request["service"],
            ]);
        }

        // artisan call make request
        if(isset($request["request"]) && !empty($request["request"])){
            Artisan::call('make:request', [
                'name'          => $request["request"],
            ]);
        }

        // artisan call make migration
        if(isset($request["table"]) && !empty($request["table"])){
            Artisan::call('make:migration', [
                'name'          => 'create_'.$request["table"].'_table',
                '--create'      => $request["table"],
            ]);
        }

        if(isset($request["controller"]) && isset($request["alias_controller"]) && !empty($request["controller"]) && $request["alias_controller"])
        {
            //Create Folder in resources/views/admin
            $path = base_path('resources/views/admin/'.$request["group"]);
            if(!file_exists($path)){
                mkdir($path, 0777, true);
            }

            //Copy All File From resources/views/admin/__base__
            $path = base_path('resources/views/admin/__base__');
            $files = glob($path.'/*');
            foreach($files as $file){
                $file_to_go = str_replace($path.'/', '', $file);
                copy($file, base_path('resources/views/admin/'.$request["group"].'/'.$file_to_go));
            }

            //Optimize Clear
            Artisan::call('optimize:clear');

            //read route/admin.php
            $file = base_path('routes/admin.php');
            $content = file_get_contents($file);

            //Replace Controller
            $content = str_replace('//++FOR NEW CONTROLLER++//', "use App\Http\Controllers\\".$request["controller"]." as ".$request["alias_controller"].";\n//++FOR NEW CONTROLLER++//", $content);

            //Replace Route
            $content = str_replace('//++FOR NEW ROUTER++//', "Route::get('".$request["group"]."/{id}/delete', [".$request["alias_controller"]."::class, 'delete'])->name('".$request["group"].".delete');\n    Route::resource('".$request["group"]."', ".$request["alias_controller"]."::class);\n\n    //++FOR NEW ROUTER++//", $content);

            //Save
            file_put_contents($file, $content);
        }

        return true;
    }
}
