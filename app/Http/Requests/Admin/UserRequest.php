<?php

namespace App\Http\Requests\Admin;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique((new User)->getTable())],
            'role' => ['required', 'exists:roles,id'],
            'password' => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['required', 'min:6'],
        ];
        if ($this->method() == "PUT" && isset($this->user)) {
            $rules['email'] = ['required', 'email', 'unique:users,email,' . $this->user->id];
            $rules['password'] = ['nullable', 'min:6', 'confirmed'];
            $rules['password_confirmation'] = ['nullable', 'min:6'];
        }
        return $rules;
    }
}
