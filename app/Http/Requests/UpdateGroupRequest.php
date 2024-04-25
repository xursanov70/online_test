<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupRequest extends FormRequest
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
            "subject_type_id" => "required|integer",
            "group_name" => "required|string|max:100",
        ];
    }

    public function messages()
    {
        return [ 
            "subject_type_id.required" => "subject_type_id kiriting",
            "subject_type_id.integer" => "subject_type_id integer holatida  kiriting",  

            "group_name.required" => "O'qituvchi darajasini kiriting",
            "group_name.string" => "Guruh nomini string holatida kiriting", 
            "group_name.max" => "Guruh nomi 50 belgidan kam bo'lishligi kerak", 
        ];
    }
}
