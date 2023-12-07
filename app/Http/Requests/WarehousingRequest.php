<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WarehousingRequest extends FormRequest
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
            'w_code' => 'required | max:15 | unique:warehousing,w_code,'.$this->id,
            'w_name' => 'required | max:255',
            'w_note' => 'nullable | max:255',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'w_code.required' => 'Vui lòng nhập mã đơn hàng',
            'w_code.max' => 'Mã đơn hàng vượt quá số ký tự cho phép',
            'w_code.unique' => 'Mã đơn hàng đã bị trùng',
            'w_name.required' => 'Vui lòng nhập vào nội dung nhập hàng',
            'w_name.max' => 'Nội dung nhập hàng vượt quá số ký tự cho phép',
        ];
    }
}
