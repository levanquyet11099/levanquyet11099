<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitsRequest extends FormRequest
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
            'u_name' => 'required | max:255 ',
            'u_code' => 'required | max:15 | unique:units,u_code,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'u_name.required' => 'Vui lòng nhập vào tên đơn vị tính',
            'u_name.max' => 'Tên đơn vị tính vượt quá số ký tự cho phép',
            'u_code.required' => 'Vui lòng nhập vào mã đơn vị tính',
            'u_code.max' => 'Mã đơn vị tính vượt quá số ký tự cho phép',
            'u_code.unique' => 'Mã đơn vị tính đã bị trùng',
        ];
    }
}
