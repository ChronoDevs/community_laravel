<?php

namespace App\Http\Requests;

use App\Http\Services\RoleService;
use Illuminate\Foundation\Http\FormRequest;

class PostCommentRequest extends FormRequest
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
            'user_id' => ['bail', 'required', 'integer', 'exists:users,id'],
            'post_id' => ['bail', 'required', 'integer', 'exists:posts,id'],
            'description' => ['bail', 'required', 'string'],
        ];
    }
}
