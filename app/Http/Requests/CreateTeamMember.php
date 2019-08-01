<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTeamMember extends FormRequest
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
            'full_name' => 'required|unique:team_members,full_name,1,is_deleted|max:100',
            'role' => 'required|max:100',
            'description' => 'required',
            'photo' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'full_name.unique'  => 'You already have <b>'.$this->input('full_name').'</b> in your team.',
            'photo.required'  => 'Please choose an image',
        ];
    }
}
