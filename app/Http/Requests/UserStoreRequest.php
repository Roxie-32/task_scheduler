<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'uname' => 'required|bail',
            'email'=>'required|email|bail|unique:users',
            'password'=>'required|bail'
        ];
    }

    public function messages()
    {
        return [
            'uname.required'=>'Username Is Required',
            'uname.bail'=>'Username Is Required',
            'email.required'=>'Email Is Required',
            'email.email'=>'enter a valid Email',
            'email.bail'=>'Email Is Required',
            'email.unique:users'=>'Email has been Taken',
            'password.required'=>'Password Is Required',
            'password.bail'=>'Password Is Required'
            


        ];
    }
}
