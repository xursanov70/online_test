<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRentRequest extends FormRequest
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
            "rent_expire_date" => 'required|date|after_or_equal:' . date('Y-m-d'),
            "rent" => "required|integer",
        ];
    }

    public function messages()
    {
        return [
            "rent.required" => "ijara summasi kiriting",
            "rent.integer" => "ijara summasi integer holatida  kiriting",  
            "rent.max" => "ijara summasi 50 belgidan kam bo'lishligi kerak",  

            "rent_expire_date.required" => "ijara amal qilish muddati kiriting",
            "rent_expire_date.date" => "ijara amal qilish muddatini date holatida kiriting",
            "rent_expire_date.after_or_equal" => "ijara amal qilish muddati hozirgi vaqtdan oldin bo'lmasligi kerak", 
        ];
    }
}
