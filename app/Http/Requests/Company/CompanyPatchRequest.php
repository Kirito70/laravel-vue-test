<?php

namespace App\Http\Requests\Company;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyPatchRequest extends FormRequest
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

        if ($this->file('logo')) {
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
                Rule::unique('companies', 'email')->ignore(
                    $this->route()->parameter('company')
                )
            ],
            'logo' => $fileRules,
            'website' => [
                'nullable'
            ]
        ];
    }
}
