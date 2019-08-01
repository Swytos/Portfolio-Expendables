<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateService extends FormRequest
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
            'name' => 'required|unique:services,name,'.$this->service_id.',id,is_deleted,0|max:100',
            'icon' => 'required',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.unique'  => 'You already have <b>'.$this->input('name').'</b> service.'
        ];
    }
}
