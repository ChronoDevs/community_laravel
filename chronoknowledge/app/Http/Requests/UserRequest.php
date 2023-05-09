<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password; //file validation for future usage

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['bail', 'required', 'string', 'alpha', 'max:100'],
            'middle_name' => ['bail', 'nullable', 'string', 'alpha', 'max:100'],
            'last_name' => ['bail', 'required', 'string', 'alpha', 'max:100'],
            'username' => ['bail', 'required', 'alpha_dash', 'max:100'],
            'nick_name' => ['bail', 'nullable', 'alpha', 'max:100'],
            'gender' => ['bail', 'nullable', 'integer', 'max:4'],
            'date_of_birth' => ['bail', 'nullable'],
            'contact_number' => ['bail', 'required', 'string', 'max:11'],
            'zip_code' => ['bail', 'required', 'string', 'max:8'],
            'address' => ['bail', 'required', 'string', 'max:100'],
            'email' => ['bail', 'required', 'email', 'email', 'max:100'],
            'password' => ['required', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised(), 'confirmed'],
            'password_confirmation' => ['bail', 'required'],
        /**
         * Reserved for future use
         */
            // 'job_title' => ['bail', 'required', 'string'],
            // 'profile' => ['bail', 'nullable', File::image()
            //     ->min(5)
            //     ->max(10 * 1024),
            // 'dimensions:min_width=20,min_height=20','mimes:jpg,jpeg,png,gif'],
        ];
    }
}
