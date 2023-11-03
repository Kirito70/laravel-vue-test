<?php

namespace App\Http\Requests\Company;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class CompanyPostRequest extends FormRequest
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
        $fileRules = [
            'nullable'
        ];

        if ($this->hasFile('logo')) {
            $fileRules[] = Rule::dimensions()
                ->minHeight(100)
                ->minWidth(100);
        }

        return [
            'name' => [
                'required'
            ],
            'email' => [
                'nullable',
                'email',
                Rule::unique('companies', 'email')
            ],
            'logo' => $fileRules,
            'website' => [
                'nullable'
            ]
        ];
    }
}
