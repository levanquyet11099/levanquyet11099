<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckInputFileRequest extends FormRequest
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
            'files' => 'required|mimes:xls,xlsx,csv'
        ];
    }

    public function messages()
    {
        return [
            'files.required'       => 'Vui lòng chọn file excel cần gửi.',
            'files.mimes'       => 'Định dạng file không được phép tải lên.',
        ];
    }
}
