<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProject extends FormRequest
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
            'name' => 'required|unique:projects,name,1,is_deleted|max:100',
            'url' => 'required|max:100',
            'team_size' => 'required|max:200',
            'platform' => 'required|max:200',
            'skills' => 'required|max:200',
            'timeline' => 'required|max:200',
            'description' => 'required',
            'image' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.unique'  => 'You already have <b>'.$this->input('name').'</b> project.',
            'photo.required'  => 'Please choose an image',
        ];
    }
}
