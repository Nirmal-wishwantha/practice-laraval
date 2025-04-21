<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Api\V1\ApiController;
use App\Services\V1\Admin\AdminService;
use App\Transformers\V1\Admin\UsersTransformer;

class AdminController extends ApiController
{
    private $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function getAll()
    {
        $result = $this->adminService->getAllUsers();
        if ($result->isErr()) {
            $err = $result->unwrapErr();
            return static::errorResponse($err['code'], $err['message'], $err['status']);
        }

        $data = $result->unwrap();
        return response()->json([
            'status' => 'success',
            'data' => (new UsersTransformer())->transform($data),
        ], 200);
    }
}
