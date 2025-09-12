<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class MemberRegistrationRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'firstname' => [
                'required',
                'string',
                'max:255',
                'min:2',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^[a-zA-Z\s\'\-\.]+$/', $value)) {
                        $fail('The ' . $attribute . ' must contain only letters, spaces, apostrophes, hyphens, and periods.');
                    }
                },
            ],
            'lastname' => [
                'required',
                'string',
                'max:255',
                'min:2',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^[a-zA-Z\s\'\-\.]+$/', $value)) {
                        $fail('The ' . $attribute . ' must contain only letters, spaces, apostrophes, hyphens, and periods.');
                    }
                },
            ],
            'middlename' => [
                'nullable',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if ($value && !preg_match('/^[a-zA-Z\s\'\-\.]+$/', $value)) {
                        $fail('The ' . $attribute . ' must contain only letters, spaces, apostrophes, hyphens, and periods.');
                    }
                },
            ],
            'contact' => [
                'required',
                'string',
                'max:20',
                function ($attribute, $value, $fail) {
                    $cleaned = preg_replace('/[^0-9+]/', '', $value);
                    if (!preg_match('/^(\+?63|0)(9[0-9]{9})$/', $cleaned)) {
                        $fail('Please enter a valid Philippine mobile number (09XXXXXXXXX or +639XXXXXXXXX).');
                    }
                },
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
                'unique:members,email'
            ],
            'terms' => 'required|accepted'
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'firstname.required' => 'First name is required.',
            'firstname.min' => 'First name must be at least 2 characters.',
            'lastname.required' => 'Last name is required.',
            'lastname.min' => 'Last name must be at least 2 characters.',
            'contact.required' => 'Contact number is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'terms.required' => 'You must accept the terms and conditions.',
            'terms.accepted' => 'You must accept the terms and conditions to proceed.'
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Additional validation for duplicate contact
            if ($this->contact) {
                $normalizedContact = $this->normalizeContact($this->contact);
                $existingMember = \App\Models\Member::where('contact', $normalizedContact)->first();
                
                if ($existingMember) {
                    $validator->errors()->add('contact', 'This contact number is already registered.');
                }
            }
        });
    }

    /**
     * Handle a failed validation attempt for AJAX requests.
     */
    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            throw new HttpResponseException(
                response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors()
                ], 422)
            );
        }

        parent::failedValidation($validator);
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        // Clean up contact number
        if ($this->has('contact')) {
            $contact = preg_replace('/[^0-9+]/', '', $this->contact);
            $this->merge(['contact' => $contact]);
        }

        // Trim whitespace from text fields
        $this->merge([
            'firstname' => trim($this->firstname ?? ''),
            'lastname' => trim($this->lastname ?? ''),
            'middlename' => trim($this->middlename ?? ''),
            'email' => strtolower(trim($this->email ?? ''))
        ]);
    }

    /**
     * Normalize contact number
     */
    private function normalizeContact($contact)
    {
        $cleaned = preg_replace('/[^0-9+]/', '', $contact);
        
        if (preg_match('/^(\+?63|0)(9[0-9]{9})$/', $cleaned, $matches)) {
            return '+63' . $matches[2];
        }
        
        return $contact;
    }
}