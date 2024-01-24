<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecruitmentRequest extends FormRequest
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
        return [
            'rec_title' => 'required',
            'rec_slug' => 'required|unique:recruitments',
            'rec_desc' => '',
            'rec_content' => '',
            'rec_seotitle' => '',
            'rec_seodesc' => '',
            'rec_spin' => '',
            'rec_template'=> '',
            'rec_status' => '',
            'rec_thumb' => '',
            'rec_quantity' => '',
            'rec_time' => '',
            'rec_money' => '',
            'rec_department' => '',
            'rec_workplace' => '',
            'rec_address' => '',
        ];
    }
}
