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
            'task_title'=>'required',
            'task_desc'=>'required',
            'task_date'=>'required|date',
            'task_time_start'=>'required|date_format:H:i',
            'task_time_end'=>'required|after_or_equal:start_date',
        ];
      
    }
    public function message(){
        return [
            'task_title.required'=>'Please enter the title of your Task',
            'task_desc.required'=>'Describe your task',
            'task_date.required'=>'Enter date',
            'task_date.date'=>'Invalid date',
            'task_time_start.required'=>'Enter a valid date',
            'task_time_start.date_format:H:i'=>'Invalid time',
            'task_time_end.required'=>'Enter a valid date',
            'task_time_end.after_or_equal:start_date'=>'Invalid time'

        ];
    }
}
