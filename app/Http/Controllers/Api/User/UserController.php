<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\CreateBusinessRequest;
use App\Http\Requests\User\UpdateNormalAccountRequest;
use App\Http\Requests\User\CreateBusinessAccountRequest;
use App\Http\Requests\User\UpdateBusinessAccountRequest;

class UserController extends Controller
{
    public function storeUser(CreateUserRequest $createUserRequest, UserService $userService) : JsonResponse
    {
        $user = $userService->createUser($createUserRequest->validated());
        return response()->json($user, 200);
    }

    public function storeBusiness(User $user, CreateBusinessRequest $createBusinessRequest, UserService $userService) :JsonResponse
    {   
        $business = $userService->createBusiness(array_merge($createBusinessRequest->validated(), ['user' => $user->toArray()]));
        return response()->json($business, 200);
    }

    public function updateUser(UpdateNormalAccountRequest $updateNormalAccountRequest, UserService $userService, $id)
    {
        $result = $userService->updateUser($updateNormalAccountRequest, $id);
        return response()->json($result, 200);
    }

    // public function updateBusiness(UpdateBusinessAccountRequest $updateBusinessAccountRequest, UserService $userService, $id)
    // {
    //     $result = $userService->updateBusiness($id, $updateBusinessAccountRequest);
    //     return response()->json($result, 200);
    // }
}
