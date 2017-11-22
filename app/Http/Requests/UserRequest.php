<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    /*Add Validtion */
    public function rules()
    {
        return [
           'first_name' => 'required|unique:users|max:25|min:3',
           'last_name' => 'required|max:25|min:3',
           'username' => 'required|unique:users|max:25|min:3',
           'email' => 'required|email|unique:users',
        ];
    }
    /*Add custom message*/
    public function messages()
{
    return [
        'first_name.required' => 'Please enter your first name',
        'last_name.required' => 'Please enter your last name',
        'username.required'  => 'username is required',
        'email.required'  => 'email is required',
        'password.required'  => 'password is required',
    ];
}
}
