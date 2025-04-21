<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\V1\ApiController;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\V1\Auth\UserRegisterRequest;
use App\Http\Requests\V1\Auth\UserLoginRequest;
use App\Services\V1\Auth\AuthService;
use App\Transformers\V1\Auth\AuthTransformer;
use League\Fractal\Serializer\ArraySerializer;

class AuthController extends ApiController
{
    /** 
     *@var AuthService
     */

    protected $authService;

    /**
     * AuthController constructor.
     * @param AuthService $authservice
     */

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $result = $this->authService->userRegister($validatedData);
        $data = $result->unwrap();
        return static::successResponse($data['massage'], 200);
    }

    public function login(UserLoginRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $result = $this->authService->userLogin($validatedData);

        if ($result->isErr()) {
            $err = $result->unwrapErr();
            $response = static::errorResponse($err['code'], $err['message'], $err['status']);
        } else {
            $data = $result->unwrap();
            $response = fractal((object) $data, new AuthTransformer, new ArraySerializer)->respond(200);
        }

        return $response;
    }
}
