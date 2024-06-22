<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Role;
use Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(in_array('create', CheckAccess())){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'              => ['required', 'string', 'max:255', 'regex:/^[^(\|\]~`!%^&*=};:?><’)]*$/'],
            'password'          => ['required', 'string', 'min:8', 'confirmed'],
            'email'             => ['required', 'email', 'unique:users'],
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'name.required'         => 'Name is required!',
    //         'name.string'           => 'Name must be string!',
    //         'email.required'        => 'Email is required!',
    //         'email.email'           => 'Email is not valid!',
    //         'email.unique'          => 'The Email has already been taken. Please use another Email!',
    //         'username.required'     => 'Username is required!',
    //         'username.unique'       => 'The Username has already been taken. Please use another Username!',
    //     ];
    // }

    public function filters()
    {
        return [
            'name'              => 'trim|capitalize|escape',
            'email'             => 'trim|lowercase',
        ];
    }
}
