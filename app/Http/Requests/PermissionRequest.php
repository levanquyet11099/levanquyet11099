<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
            //
            'name' => 'required | max:191 | unique:permissions,name,'.$this->id,
            'description' => ['nullable', 'max:150'],
            'group_permission_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập vào tên quyền',
            'name.unique' => 'Tên quyền không thể trùng nhau',
            'name.max' => 'Tên quyền vượt quá số ký tự cho phép',
            'description.max' => 'Mô tả vượt quá số ký tự cho phép',
            'group_permission_id.required' => 'Vui lòng chọn nhóm quyền',
        ];
    }
}
