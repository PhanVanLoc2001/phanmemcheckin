<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id = $this->route('page');
        return [
            'page_title' => 'required',
            'page_slug' => [
                'required',
                Rule::unique('pages')->ignore($id)
            ],
            'page_desc' => 'max:320',
            'page_seodesc' => 'max:320',
            'page_seotitle' => 'required',
            'page_content' => '',
            'page_status' => '',
            'page_templates' => '',
            'page_thumb' => '',
        ];
    }
    public function messages(): array
    {
        return [
            'page_title.required' => 'Vui lòng nhập tiêu đề Trang.',
            'page_slug.required' => 'Đường dẫn không được bỏ trống!',
            'page_slug.unique' => 'Đường dẫn này đã tồn tại trên hệ thống!',
            'page_desc.max:100' => 'Không quá 100 ký tự',
            'page_seodesc.max:100' => 'Không quá 100 ký tự',
            'page_seotitle.required' => 'Vui lòng nhập tiêu đề',
        ];
    }
}
