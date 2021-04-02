<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
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
            'title'=>'required',
            'description'=>'required',
            'datetime'=>'required|date',
            'completed'=>'required|boolean',
        ];
      
    }
    public function messages(){
        return [
            'title.required'=>'Please enter the title of your Task',
            'description.required'=>'Describe your task',
            'date.required'=>'Please enter your date',
            'datetime.date'=>'Please enter a valid date',
            'completed.required'=>'Is your task completed?',
            'completed.boolean'=>'Enter either true or false',
            
        ];
    }
}
