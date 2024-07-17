<?php

use App\Models\Role;
use App\Models\RoleMenu;
use App\Models\Menu;

// use BaconQrCode\Renderer\Image\Png;
// use BaconQrCode\Writer;

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

if (!function_exists('RenderJson')) {
    function RenderJson($dataJson, $object, $value = null){
        if(gettype($dataJson) == 'array'){
            $dataJson = json_encode($dataJson);
        }
        
        if(!empty(json_decode($dataJson, true)[$object])){
            $class = json_decode($dataJson, true)[$object];
        } else {
            $class = $value;
        }
        return $class;
    }
}

if (!function_exists('MenuButtonAction')) {
    function MenuButtonAction($type = [], $pages = []){
        $btn = '';
        $btn .= '<ul class="action text-center">';
        if(in_array('read', CheckAccess()) && in_array('show', $type)){
            $btn .= '<li class="view"><a href="'.$pages['show']['url'].'" class="hover-up" ><i class="icon-eye"></i></a>&nbsp;&nbsp;</li>';
        }
        if(in_array('update', CheckAccess()) && in_array('edit', $type)){
            $btn .= '<li class="edit"><a href="'.$pages['edit']['url'].'" class="hover-up"><i class="icon-pencil-alt"></i></a></li>';
        }
        if(in_array('delete', CheckAccess()) && in_array('delete', $type)){
            $btn .= '<li class="delete"><a href="#" class="hover-up remove" data-action="'.$pages['delete']['url'].'" data-id="'.$pages['delete']['id'].'"><i class="icon-trash"></i></a></li>';
        }
        $btn .= '</ul>';
        return $btn;
    }
}

if (!function_exists('ButtonAction')) {
    function ButtonAction($type = [], $pages = [], $isBack = false, $isBackUrl = null){
        $btn = '';

        if(in_array('create', $type)){
            if(in_array('create', CheckAccess())){
                $btn .= '<a class="btn btn-primary hover-up" href="'.$pages['page']['create']['url'].'">Create</a>';
            }
        }
        

        if(in_array('update', $type) || in_array('delete', $type) || in_array('show', $type)){
            $btn .= '<ul class="action text-center">';
            if(in_array('read', CheckAccess())){
                $btn .= '<li class="view"><a href="'.$pages['show']['url'].'" class="hover-up" ><i class="icon-eye"></i></a>&nbsp;&nbsp;</li>';
            }
            if(in_array('update', CheckAccess())){
                $btn .= '<li class="edit"><a href="'.$pages['edit']['url'].'" class="hover-up"><i class="icon-pencil-alt"></i></a></li>';
            }
            if(in_array('delete', CheckAccess())){
                $btn .= '<li class="delete"><a href="#" class="hover-up remove" data-action="'.$pages['delete']['url'].'" data-id="'.$pages['delete']['id'].'"><i class="icon-trash"></i></a></li>';
            }
            $btn .= '</ul>';
        }

        if(in_array('save', $type)){
            if(in_array('create', CheckAccess())){
                $btn .= '<button type="submit" form="dataStore" class="btn btn-primary hover-up">Save</button>';
            }
        }

        if(in_array('edit', $type)){
            if(in_array('update', CheckAccess())){
                $btn .= '<button type="submit" form="dataUpdate" class="btn btn-primary hover-up">Update</button>';
            }
        }

        if(in_array('edit_show', $type)){
            if(in_array('update', CheckAccess())){
                $btn .= '<a class="btn btn-success hover-up" href="'.$pages['page']['edit']['url'].'"><i class="icon-pencil-alt"></i> Edit</a>';
                // $btn .= '&nbsp;&nbsp;&nbsp; <a class="btn btn-outline-light" href="'.$pages['page']['index']['url']).'">Back</a>';
            }
        }
        // <ul class="action">
        //     <li class="edit"><a href="#"><i class="icon-pencil-alt"></i></a></li>
        //     <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
        // </ul>

        if($isBack){
            $btn .= '&nbsp;&nbsp;&nbsp; <a class="btn btn-outline-light" href="'.$pages['page']['index']['url'].'">Back</a>';
        }

        if($isBackUrl != null){
            $btn .= '&nbsp;&nbsp;&nbsp; <a class="btn btn-outline-light" href="'.$isBackUrl.'">Back</a>';
        }

        return $btn;
    }
}

//function check access
if (!function_exists('CheckAccess')) {
    function CheckAccess(){

        //Check Current Route Session
        if(session('check_access_'.session('default_role').'_'.str_replace(".","_",\Route::currentRouteName())) == null
        || session('check_access_'.session('default_role').'_'.str_replace(".","_",\Route::currentRouteName())) == ''){

            //If empty create a first destination
            $menu = Menu::select('group')->whereIsActive(1)->whereRoute(\Route::currentRouteName())->first();
            $role = RoleMenu::select('access')->where('role_slug', session('default_role'))->where('menu_group', $menu->group)->first();

            session([
                'check_access_'.session('default_role').'_'.str_replace(".","_",\Route::currentRouteName()) => $role->access
            ]);

            $RoleAccess = $role->access;

        }

        return session('check_access_'.session('default_role').'_'.str_replace(".","_",\Route::currentRouteName()));
    }
}

//Button Action
if (!function_exists('ButtonAction_')) {
    function ButtonAction_($data = []){
        $btn = '';

        if(in_array('update', CheckAccess())){
            $btn .= '<a href="'.$data['edit']['url'].'" class="btn btn-sm btn-brand rounded font-sm mt-15">'.(isset($data['edit']['icon']) ? '<i class="material-icons '.$data['edit']['icon'].'"></i>' : '').' '.$data['edit']['label'].'</a>';
        }

        if(in_array('delete', CheckAccess())){
            $btn .= '&nbsp;<a href="#" class="btn btn-sm btn-danger rounded font-sm mt-15 remove" data-action="'.$data['delete']['url'].'" data-id="'.$data['delete']['id'].'">'.(isset($data['delete']['icon']) ? '<i class="material-icons '.$data['delete']['icon'].'"></i>' : '').' '.$data['delete']['label'].'</a>';
        }

        return $btn;
    }
}


if (!function_exists('ButtonEdit')) {
    function ButtonEdit($data = []){
        $btn = '';

        if(in_array('update', CheckAccess())){
            $btn .= '<a href="'.$data['url'].'" class="btn btn-sm btn-brand rounded font-sm mt-15">'.(isset($data['icon']) ? '<i class="material-icons '.$data['icon'].'"></i>' : '').' '.$data['label'].'</a>';
        }

        return $btn;
    }
}

//Status
if (!function_exists('Status')) {
    function Status($status){
        $class = '';
        if($status == 't' || $status == true){
            $class = '<span class="badge rounded-pill alert-success">TRUE</span>';
        }else{
            $class = '<span class="badge rounded-pill alert-danger">FALSE</span>';
        }

        return $class;
    }
}

//Wilayah
if (!function_exists('Wilayah')) {
    function Wilayah($id){
        $data = \App\Models\Wilayah::whereKode($id)->first();
        if(!empty($data))
        {
            return $data->nama;
        } else
        {
            return '<strong><i>Tidak Ada Wilayah</i></strong>';
        }
    }
}

if (!function_exists('FormText')) {
    function FormText($label, $name, $placeholder, $required = false, $value = "old", $readonly = false, $m = "mb-1"){
        $class = '';

        if($value != "old"){
            $val = $value;
        } else {
            $val = old($name);
        }

        if($required == true){
            $req = 'required ';
            $reqspan = '<span class="text-danger">*</span>';
        } else {
            $req = '';
            $reqspan = '';
        }

        if($name == 'email'){
            $type = "email";
        } else if($name == 'password' || $name == 'password_confirmation'){
            $type = "password";
        } else {
            $type = "text";
        }

        $classinvalid = '';
        $message = '';

        if(session('errors')){
            if(session('errors')->has($name)){
                $classinvalid = 'is-invalid';
                $message = session('errors')->get($name)[0];
            }
        }

        if($readonly){
            $readonlyAttr = 'readonly';
        } else {
            $readonlyAttr = '';
        }

        $class = '<div class="'.$m.'">
                    <label class="form-label" for="'.$name.'">'.__($label).''.$reqspan.'</label>
                    <input id="'.$name.'" name="'.$name.'" value="'.$val.'" placeholder="'.__($placeholder).'" type="'.$type.'" class="form-control form-control-sm '.$classinvalid.'" '.$req.' '.$readonlyAttr.'/>';
                    if($message != ''){
                        $class .= '<span class="invalid-feedback" role="alert"><strong>'.__($message).'</strong></span>';
                    }
        $class .= '</div>';



        return $class;
    }
}

if (!function_exists('FormSelect')) {
    function FormSelect($label, $name, $placeholder, $data = [], $required = false, $value = "old", $disabled = false, $m = "mb-1"){
        $class = '';

        if($value != "old"){
            $val = $value;
        } else {
            $val = old($name);
        }

        if($required == true){
            $req = 'required ';
            $reqspan = '<span class="text-danger">*</span>';
        } else {
            $req = '';
            $reqspan = '';
        }

        $option = '';
        if(count($data) >= 1){
            foreach($data as $d){
                if($val==$d["id"]){
                    $selected = 'selected';
                } else {
                    $selected = '';
                }

                $option .= '<option value="'.$d["id"].'" '.$selected.'>'.$d["name"].'</option>';
            }
        }

        $classinvalid = '';
        $message = '';

        if(session('errors')){
            if(session('errors')->has($name)){
                $classinvalid = 'is-invalid';
                $message = session('errors')->get($name)[0];
            }
        }

        if($disabled){
            $disabledAttr = 'disabled';
        } else {
            $disabledAttr = '';
        }

        $class = '<div class="'.$m.'">
                    <label class="form-label" for="'.$name.'">'.__($label).''.$reqspan.'</label>
                    <select class="form-select form-select-sm " '.$disabledAttr.' name="'.$name.'" id="'.$name.'" '.$req.'>
                        <option selected="" disabled="">-- '.__($placeholder).' --</option>'.__($option).'
                    </select>';
                    if($message != ''){
                        $class .= '<span class="invalid-feedback" role="alert"><strong>'.__($message).'</strong></span>';
                    }
        $class .= '</div>';

        return $class;
    }
}

if (!function_exists('FormSelect2')) {
    function FormSelect2($label, $name, $placeholder, $data = [], $multiple = true, $required = true, $value = "old", $disabled = false, $m = "mb-2"){
        $class = '';

        if($value != "old"){
            $val = $value;
        } else {
            $val = old($name);
        }

        if($required == true){
            $req = 'required ';
            $reqspan = '<span class="text-danger">*</span>';
        } else {
            $req = '';
            $reqspan = '';
        }

        if($multiple == true){
            $multiple = 'multiple = "multiple"';
            $optionNull = '';
            $idAttr = $name;
            $name = $name.'[]';
        } else {
            $multiple = '';
            $optionNull = '<option></option>';
            $idAttr = $name;
        }

        if(count($data) >= 1){
            $option = '';
            foreach($data as $d){
                if($val==$d["id"]){
                    $selected = 'selected';
                } else {
                    $selected = '';
                }

                $option .= $optionNull.'<option value="'.$d["id"].'" '.$selected.'>'.$d["name"].'</option>';
            }
        }

        $classinvalid = '';
        $message = '';

        if($label == ''){
            $labelAttr = '&nbsp;';
        } else {
            $labelAttr = '<label class="form-label" for="'.$name.'">'.$label.''.$reqspan.'</label>';
        }

        if(session('errors')){
            if(session('errors')->has($name)){
                $classinvalid = 'is-invalid';
                $message = session('errors')->get($name)[0];
            }
        }

        if($disabled){
            $disabledAttr = 'disabled';
        } else {
            $disabledAttr = '';
        }

        $class = '<div class="'.$m.'">
                    '.$labelAttr.'
                    <div class="custom_select">
                    <select class="form-select form-select-sm select-nice select2Form" '.$disabledAttr.' name="'.$name.'" id="'.$idAttr.'" '.$req.' '.$multiple.'>
                        '.$option.'
                    </select>
                    </div>';
                    if($message != ''){
                        $class .= '<span class="invalid-feedback" role="alert"><strong>'.$message.'</strong></span>';
                    }
        $class .= '</div>';

        return $class;
    }
}

if (!function_exists('FormNumber')) {
    function FormNumber($label, $name, $placeholder, $required = false, $readonly = false, $value = "old", $m = "mb-4"){
        $class = '';

        if($value != "old"){
            $val = $value;
        } else {
            $val = old($name);
        }

        if($required == true){
            $req = 'required ';
            $reqspan = '<span class="text-danger">*</span>';
        } else {
            $req = '';
            $reqspan = '';
        }

        $classinvalid = '';
        $message = '';

        if(session('errors')){
            if(session('errors')->has($name)){
                $classinvalid = 'is-invalid';
                $message = session('errors')->get($name)[0];
            }
        }

        if($readonly){
            $readonlyAttr = 'readonly';
        } else {
            $readonlyAttr = '';
        }

        $class = '<div class="'.$m.'">
                    <label class="form-label" for="'.$name.'">'.$label.''.$reqspan.'</label>
                    <input id="'.$name.'" name="'.$name.'" value="'.$val.'" placeholder="'.$placeholder.'" type="number" class="form-control required-check '.$classinvalid.'" '.$req.' '.$readonlyAttr.'/>';
                    if($message != ''){
                        $class .= '<span class="invalid-feedback" role="alert"><strong>'.$message.'</strong></span>';
                    }
        $class .= '</div>';



        return $class;
    }
}

if (!function_exists('FormDate')) {
    function FormDate($label, $name, $placeholder, $required = false, $type = null, $withTime = false, $value = "old", $m = "mb-4"){
        $class = '';

        if($value != "old"){
            $val = $value;
        } else {
            $val = old($name);
        }

        if($required == true){
            $req = 'required ';
            $reqspan = '<span class="text-danger">*</span>';
        } else {
            $req = '';
            $reqspan = '';
        }

        if($withTime == true){
            $withTime = 'datetime-local';
        } else {
            $withTime = 'date';
        }

        if(!empty($type) && $type='month'){
            $withTime = 'month';
        } else {
            $withTime = $withTime;
        }

        $classinvalid = '';
        $message = '';

        if(session('errors')){
            if(session('errors')->has($name)){
                $classinvalid = 'is-invalid';
                $message = session('errors')->get($name)[0];
            }
        }

        $class = '<div class="'.$m.'">
                    <label class="form-label" for="'.$name.'">'.$label.''.$reqspan.'</label>
                    <input id="'.$name.'" name="'.$name.'" value="'.$val.'" placeholder="'.$placeholder.'" type="'.$withTime.'" class="form-control required-check '.$classinvalid.'" '.$req.'/>';
                    if($message != ''){
                        $class .= '<span class="invalid-feedback" role="alert"><strong>'.$message.'</strong></span>';
                    }
        $class .= '</div>';



        return $class;
    }
}

if (!function_exists('FormFile')) {
    function FormFile($label, $name, $placeholder, $accept, $required = false, $value = "old", $m = "mb-4"){
        $class = '';

        if($value != "old"){
            $val = $value;
        } else {
            $val = old($name);
        }

        if($required == true){
            $req = 'required ';
            $reqspan = '<span class="text-danger">*</span>';
        } else {
            $req = '';
            $reqspan = '';
        }

        $classinvalid = '';
        $message = '';

        if(session('errors')){
            if(session('errors')->has($name)){
                $classinvalid = 'is-invalid';
                $message = session('errors')->get($name)[0];
            }
        }

        $class = '<div class="'.$m.'">
                    <label class="form-label" for="'.$name.'">'.$label.''.$reqspan.'</label>
                    <input id="'.$name.'" name="'.$name.'" value="'.$val.'" placeholder="'.$placeholder.'" type="file" accept="'.$accept.'" class="form-control required-check '.$classinvalid.'" '.$req.'/>';
                    if($message != ''){
                        $class .= '<span class="invalid-feedback" role="alert"><strong>'.$message.'</strong></span>';
                    }
        $class .= '</div>';



        return $class;
    }
}


if (!function_exists('TextToArray')) {
    function TextToArray($data){
        return json_encode($data);
    }
}


//Option Sesion Role
if (!function_exists('OptionSessionRole')) {
    function OptionSessionRole(){
        $data = \App\Models\UserRole::whereUserId(\Auth::user()->id)->first();
        return $data->roles;
    }
}

if (!function_exists('UploadFile')) {
    function UploadFile($data, $path, $fileRemove = null, $id = null, $typePath = null){
        if($fileRemove != null){
            if($typePath == 'storage'){
                if(file_exists(storage_path('app/public/'.$path.'/'.$fileRemove))){
                    unlink(storage_path('app/public/'.$path.'/'.$fileRemove));
                }
            } else {
                if(file_exists($path.$fileRemove)){
                    unlink($path.$fileRemove);
                }
            }
        }

        if($id != null){
            $filename = $id.'_'.time().'.'.$data->extension();
        } else {
            $filename = time().'.'.$data->extension();
        }

        if($typePath == 'storage'){
            $pathFolder = storage_path('app/public/'.$path);
        } else {
            $pathFolder = public_path($path);
        }

        $data->move($pathFolder, $filename);

        return $filename;
    }
}

if (!function_exists('RemoveFile')) {
    function RemoveFile($path, $fileRemove, $typePath = null){
        if($fileRemove != null){
            if($typePath == 'storage'){
                if(file_exists(storage_path('app/public/'.$path.'/'.$fileRemove))){
                    unlink(storage_path('app/public/'.$path.'/'.$fileRemove));
                }
            } else {
                if(file_exists($path.$fileRemove)){
                    unlink($path.$fileRemove);
                }
            }
        }

        return true;
    }
}

if (!function_exists('ToogleAsideMini')) {
    function ToogleAsideMini(){
        $routeList = [];
        if(in_array(Route::currentRouteName(), $routeList)){
            return 'aside-mini';
        } else {
            return '';
        }
    }
}

if (!function_exists('defaultRoute')) {
    function defaultRoute(){
        if(session()->has('default_role')){
            $route = \App\Models\Role::where('slug', session('default_role'))->first()->default_route;
        } else {
            $route = 'index';
        }

        return $route;
    }
}

if (!function_exists('getSlugRole')) {
    function getSlugRole($id){
        return \App\Models\Role::where('id', $id)->first()->slug;
    }
}

if (!function_exists('generateQRCode')) {
    function generateQRCode($url, $w = 300, $h = 300)
    {
        $renderer = new \BaconQrCode\Renderer\Image\Png();
        $renderer->setHeight($h);
        $renderer->setWidth($w);
        $writer = new \BaconQrCode\Writer($renderer);
        $qrcode = $writer->writeString($url);

        return '<img src="data:image/png;base64,'.$qrcode.'" alt="QR Code">';
    }
}