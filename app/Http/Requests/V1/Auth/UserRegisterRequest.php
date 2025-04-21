<?php

namespace App\Http\Requests\V1\Auth;

use App\Rules\UserRoleManage;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest

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

        $nameRule =['required','max:250','regex:/^[A-Za-z]+(?:\s[A-Za-z]+)*$/'];
        return [
            'name' => $nameRule,
            'email'=>['required','email','unique:users'],
            'role_id' => ['required', 'integer', new UserRoleManage],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
     }
}
