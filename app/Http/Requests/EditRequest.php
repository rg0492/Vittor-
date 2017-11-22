<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
    public function rules()
    {
       
        return [
           'first_name' => 'required|max:25|min:3',
           'last_name' => 'required|max:25|min:3',
           'username' => 'required|max:25|min:3',
           'email' => 'required|email',
        ];
    }
}