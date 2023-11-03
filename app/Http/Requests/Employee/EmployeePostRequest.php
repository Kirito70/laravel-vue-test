<?php

namespace App\Http\Requests\Employee;

use App\Models\Employee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeePostRequest extends FormRequest
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
            'first_name' => [
                'required'
            ],
            'last_name' => [
                'required'
            ],
            'email' => [
                'nullable',
                'email',
                Rule::unique('employees', 'email')
            ],
            'company_id'=> [
                'required',
                Rule::exists(
                    'companies',
                    'id'
                )
            ],
            'phone' => [
                'nullable'
            ]
        ];
    }
}