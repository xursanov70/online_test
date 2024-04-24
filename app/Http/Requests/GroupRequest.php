<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "organization_id" => "required|integer",
            "subject_type_id" => "required|integer",
            "group_name" => "required|string|max:50",
        ];
    }

    public function messages()
    {
        return [
            "organization_id.required" => "organization_id kiriting",
            "organization_id.integer" => "organization_id integer holatida  kiriting",  

            "subject_type_id.required" => "subject_type_id kiriting",
            "subject_type_id.integer" => "subject_type_id integer holatida  kiriting",  

            "group_name.required" => "O'qituvchi darajasini kiriting",
            "group_name.string" => "Guruh nomini string holatida kiriting", 
            "group_name.max" => "Guruh nomi 50 belgidan kam bo'lishligi kerak", 
        ];
    }
}
