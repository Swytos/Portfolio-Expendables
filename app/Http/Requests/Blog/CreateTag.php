<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class CreateTag extends FormRequest
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
            'tag_name' => 'required|unique:tags',
        ];
    }

    public function messages()
    {
        return [
            'tag_name.unique'  => 'You already have <b>'.$this->input('tag_name').'</b> tag.',
        ];
    }
}
