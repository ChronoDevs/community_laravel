<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;
use App\Http\Services\RoleService;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return RoleService::isUser();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => ['bail', 'required', 'integer'],
            'category' => ['bail', 'required', 'string'],
            'title' => ['bail', 'required', 'string', 'max:100'],
            'description' => ['bail', 'required'],
            // 'html_description' => ['bail', 'required', 'string'],
            'tag' => ['bail', 'required', 'string']
        ];
    }
}
