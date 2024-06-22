<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuGroupRequest extends FormRequest
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
            'slug'              => ['string', 'max:255', 'regex:/^[^(\|\]~`!%^&*=};:?><’)]*$/'],
            'name'              => ['required', 'string', 'max:255', 'regex:/^[^(\|\]~`!%^&*=};:?><’)]*$/'],
            'description'       => ['required', 'string', 'max:255', 'regex:/^[^(\|\]~`!%^&*=};:?><’)]*$/'],
            'order'             => ['required', 'integer'],
        ];
    }
}
