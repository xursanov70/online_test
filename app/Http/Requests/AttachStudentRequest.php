<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachStudentRequest extends FormRequest
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
            "user_id" => "required|integer",
            "group_id" => "required|integer",
        ];
    }

    public function messages()
    {
        return [
            "user_id.required" => "user_id kiriting",
            "user_id.integer" => "user_id integer holatida  kiriting",  

            "group_id.required" => "group_id kiriting",
            "group_id.integer" => "group_id integer holatida  kiriting",  

        ];
    }
}
