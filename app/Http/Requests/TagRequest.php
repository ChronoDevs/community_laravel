<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Services\RoleService;

class TagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return RoleService::isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['bail', 'required', 'string', 'max:100', 'alpha_dash'],
            'plain_description' => ['bail', 'required', 'string'],
            'html_description' => ['bail', 'required', 'string']
        ];
    }
}
