<?php

namespace App\Services\User;

use App\Exceptions\BusinessOwnershipException;
use Exception;
use App\Models\Business;
use App\Models\User;    
use App\Repositories\User\UserRepository;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\CreateAccountRequest;
use App\Http\Requests\User\CreateBusinessRequest;
use App\Http\Requests\User\UpdateNormalAccountRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }
    
    public function findAll(): LengthAwarePaginator
    {
        return $this->userRepository->findAll();
    }

    public function getUserById(int $id): User
    {
        return $this->userRepository->getUserById($id);
    }

    public function createUser(array $createUserRequest): User
    {
        return $this->userRepository->createUser($createUserRequest);
    }

    public function createBusiness(array $createBusinessRequest) : Business
    {
        $user = $this->getUserById($createBusinessRequest['user']['id']);

        if($user === null){
            throw new ModelNotFoundException('User not found', 404);
        }
        //remove the user key from the array
        unset($createBusinessRequest['user']);

        if($user->business_id !== null){
            throw new BusinessOwnershipException('User already has a business', 422);
        }

        $business = $this->userRepository->createBusiness($createBusinessRequest);
        
        $this->assignCompanyToUser($user, $business);

        return $business;
    }

    public function assignCompanyToUser(User $user, Business $business) : void
    {
        $this->userRepository->assignCompanyToUser($user, $business);
    }

    // public function updateUser(UpdateNormalAccountRequest $updateNormalAccountRequest, int $id): User
    // {
    //     return $this->userRepository->updateUser($updateNormalAccountRequest, $id);
    // }

    // public function updateBusiness(int $id, array $data): array
    // {
    //     return $this->userRepository->updateBusiness($id, $data);
    // }

}