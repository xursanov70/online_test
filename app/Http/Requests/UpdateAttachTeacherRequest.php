<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttachTeacherRequest extends FormRequest
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
            "degree" => "required|in:high,medium,low",
        ];
    }

    public function messages()
    {
        return [
            "subject_type_id.required" => "subject_type_id kiriting",
            "subject_type_id.integer" => "subject_type_id integer holatida  kiriting",  

            "degree.required" => "O'qituvchi darajasini kiriting",
            "degree.in" => "O'qituvchi darajasini tp'g'ri kiriting", 
        ];
    }
}
