<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
        return  [
            'post_title' => 'required',
            'post_slug' => 'required|unique:posts',
            'post_desc'=>'max:320',
            'post_seodesc'=>'max:320',
            'post_seotitle'=>'required',
            'post_content'=>'',
            'post_keyword'=>'nullable',
            'post_status'=>'nullable|string',
            'post_spinned'=>'nullable|string',
            'post_lang'=>'nullable|string',
            'post_templates'=>'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'post_title.required' => 'Vui lòng nhập tiêu đề bài viết.',
            'post_slug.required' => 'Đường dẫn không được bỏ trống!',
            'post_slug.unique' => 'Đường dẫn này đã tồn tại trên hệ thống!',
            'post_desc.max:100'=>'Không quá 100 ký tự',
            'post_seodesc.max:100'=>'Không quá 100 ký tự',
            'post_seotitle.required'=>'Vui lòng nhập tiêu đề',
        ];
    }
}
