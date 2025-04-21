<?php

namespace App\Services\V1\Admin;

use App\Models\User;
use Prewk\Result\Err;
use Prewk\Result\Ok;

class AdminService
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAllUsers()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            return new Err([
                'code' => 'no_users_found',
                'message' => 'No Users Found',
                'status' => 404,
            ]);
        }

        return new Ok($users);
    }
}
