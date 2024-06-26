<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendCodeRequest extends FormRequest
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
            "email" => "required|max:100|min:7|unique:users,email,except,id",
        ];
    }

    public function messages()
    {
        return [
            "email.required" => "email kiriting",
            "email.unique" => "Siz oldin kiritilgan email address kiritdingiz",
            "email.max" => "email belgilangan miqdordan ko'p kiritildi", 
            "email.min" => "yaroqsiz email address kiritdingiz", 
        ];
    }
}
