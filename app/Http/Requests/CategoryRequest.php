<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'c_name' => 'required | max:255 ',
            'c_code' => 'required | max:15 | unique:category,c_code,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'c_name.required' => 'Vui lòng nhập vào tên loại mặt hàng',
            'c_name.max' => 'Tên loại mặt hàng vượt quá số ký tự cho phép',
            'c_code.required' => 'Vui lòng nhập vào mã loại mặt hàng',
            'c_code.max' => 'Mã loại mặt hàng vượt quá số ký tự cho phép',
            'c_code.unique' => 'Mã loại mặt hàng đã bị trùng',
        ];
    }
}
