<?php

namespace App\Rules;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Rule;

class UserRoleManage implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = Auth::user();
        $userRoleId = $user->role_id;
        $allowedRoles = [];

        if ($userRoleId === 1) {
            $allowedRoles = [2, 3, 4, 5, 6, 7, 8];
        } elseif ($userRoleId === 2) {
            $allowedRoles = [3, 4, 5, 6, 7, 8];
        } elseif (in_array($userRoleId, [3, 4, 5, 6, 7])) {
            $allowedRoles = [8];
        }

        return in_array($value, $allowedRoles);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('Enter a valid role id.');
    }
}