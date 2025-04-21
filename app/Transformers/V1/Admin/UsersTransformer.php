<?php
namespace App\Transformers\V1\Admin;

use Illuminate\Database\Eloquent\Collection;

class UsersTransformer
{
    public function transform(Collection $users): array
    {
        return $users->map(function ($user) {
            return [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'address' => $user->address,
                'dob' => $user->dob,
                'role_id' => $user->role_id,
                'is_active' => $user->is_active,
                'created_at' => $user->created_at->toDateTimeString(),
                'updated_at' => $user->updated_at->toDateTimeString(),
            ];
        })->toArray();
    }
}
