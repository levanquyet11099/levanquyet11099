<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class GroupPermissionRequest extends FormRequest
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
            'name'     => 'required|unique:group_permission,name,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => 'Mời bạn nhập nhóm quyền',
            'name.unique'      => 'Nhóm quyền này đã tồn tại',
        ];
    }
}
