<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'nullable|string|unique:employees,phone|max:15',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'The first name is required.',
            'first_name.string' => 'The first name must be a string.',
            'first_name.max' => 'The first name may not be greater than 255 characters.',
            'last_name.required' => 'The last name is required.',
            'last_name.string' => 'The last name must be a string.',
            'last_name.max' => 'The last name may not be greater than 255 characters.',
            'company_id.required' => 'The company is required.',
            'company_id.exists' => 'The selected company does not exist.',
            'email.required' => 'The email address is required.',
            'email.email' => 'The email address must be a valid email address.',
            'email.unique' => 'The email address has already been taken.',
            'phone.string' => 'The phone number must be a string.',
            'phone.unique' => 'The phone number has already been taken.',
            'phone.max' => 'The phone number may not be greater than 15 characters.',
        ];
    }
}
