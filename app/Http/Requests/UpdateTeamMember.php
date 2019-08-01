<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamMember extends FormRequest
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
            'full_name' => 'required|unique:team_members,full_name,'.$this->member_id.',id,is_deleted,0|max:100',
            'role' => 'required|max:100',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'full_name.unique'  => 'You already have <b>'.$this->input('full_name').'</b> in your team.'
        ];
    }
}
