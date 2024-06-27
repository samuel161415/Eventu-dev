<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Models\Business;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\CreateUserRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\User\CreateBusinessRequest;
use App\Http\Requests\User\UpdateNormalAccountRequest;

class UserRepository 
{
    public function createUser(array $userData): User
    {
        $user = new User();

        $user->first_name = $userData['first_name'];
        $user->last_name = $userData['last_name'];
        $user->email = $userData['email'];
        $user->user_type = 'user'; 
        $user->password = Hash::make($userData['password']);
        $user->save();
        return $user;
    }      
    
    
    public function createBusiness(array $data): Business
    {
        //Get the business owner
        $business = new Business();
        $business->name = $data['name']; 
        $business->slogan = $data['slogan']??null;
        $business->short_description = $data['short_description']??null;
        $business->city = $data['city'];
        $business->district = $data['district'];
        $business->address = $data['address'];
        $business->profile_picture_url = $data['profile_picture_url']??null;
        $business->cover_photo_url = $data['cover_photo_url']??null;
        $business->phone = $data['phone']??null;
        $business->email = $data['email'];
        $business->website_url = $data['website_url']??null;
        $business->fiscal_attribute = $data['fiscal_attribute']??null;
        $business->identification_code = $data['identification_code']??null;
        $business->control_digit = $data['control_digit']??null;
        $business->registration_prefix = $data['registration_prefix']??null;
        $business->county_code = $data['county_code']??null;
        $business->order_number = $data['order_number']??null;
        $business->registration_year = $data['registration_year']??null; 
        // Save the business record
        $business->save();
        return $business;
    } 

    public function updateBusinessAccount(array $data, Business $business): Business
    {
        $business->name = $data['name'];
        $business->slogan = $data['slogan'];
        $business->short_description = $data['short_description'];
        $business->city = $data['city'];
        $business->district = $data['district'];
        $business->address = $data['address'];
        $business->profile_picture_url = $data['profile_picture_url'];
        $business->cover_photo_url = $data['cover_photo_url'];
        $business->phone = $data['phone'];
        $business->email = $data['email'];
        $business->website_url = $data['website_url'];

        $business->save();
        return $business;
    }

    public function updateUser(UpdateNormalAccountRequest $updateNormalAccountRequest, $userId): User
    {
        $user = User::findOrFail($userId);

        $user->first_name = $updateNormalAccountRequest['first_name'];
        $user->last_name = $updateNormalAccountRequest['last_name'];
        $user->email = $updateNormalAccountRequest['email'];
        $user->account_type = 'user'; 
        $user->password = Hash::make($updateNormalAccountRequest['password']);
        $user->save();
        return $user;

        // return $user;
    }

    public function getUserById(int $userId): ?User
    {
        return User::findOrFail($userId);
    }

    public function assignCompanyToUser(User $user, Business $business) : bool
    {
        $user->business_id = $business->id;
        $user->save();

        return true;
    }

    public function findAll(): LengthAwarePaginator
    {
        return User::paginate(20);
    }

}