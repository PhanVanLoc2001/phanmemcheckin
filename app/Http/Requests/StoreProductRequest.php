<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        //        dd(1);
        return [
            'prod_name' => 'required',
            'prod_slug' => 'required',
            'prod_desc' => '',
            'prod_content' => 'nullable|string',
            'prod_seotitle' => 'required',
            'prod_seodesc' => '',
            'prod_spin' => 'boolean',
            'prod_status' => 'nullable|string',
            'prod_price' => '',
            'prod_excerpt' => '',
            'prod_saleprice' => '',
            'download' => 'nullable|string',
            'update' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'prod_name.required' => ' không được bỏ trống',
            'prod_slug.required' => ' không được bỏ trống',
            'prod_price.required' => ' không được bỏ trống',
            'prod_saleprice.required' => ' không được bỏ trống',
            'prod_seotitle.required' => ' không được bỏ trống',
            'prod_price.numeric' =>  ' bắt buộc phải là số',
            'prod_price.min:0' =>    ' không được nhỏ hơn 0',
            'prod_desc.max:100' =>   ' không quá 100 ký tự',
            'prod_seodesc.max:100' => ' không quá 100 ký tự',
        ];
    }

    public function attributes(): array
    {
        return [
            'prod_name' => 'Tên sản phẩm ',
            'prod_slug' => 'Đường dẫn ',
            'prod_price' => 'Giá ',
            'prod_saleprice' =>  'Giá sale',
            'prod_desc' =>   'Mô tả ngắn',
            'prod_seodesc' =>   'Mô tả seo ngắn',
        ];
    }
}
