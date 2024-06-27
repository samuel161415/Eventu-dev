<?php
namespace Tests\Feature\Users;

use Tests\TestCase;
use App\Models\User;
use App\Models\Business;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testCreateUser(): void
    {
        $user = User::factory()->make();

        $response = $this->postJson('api/v1/inregistrare/user', $user->toArray());

        $response->assertStatus(200);

        $userData = $array = collect($user->toArray())->except(['email_verified_at', 'password'])->toArray();
        $response->assertJsonFragment($userData);
        $this->assertDatabaseHas('users', [
            'email' => $user->email,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'user_type' => 'user'
        ]);
    }

    public function testCreateBusiness(): void
    {
        $user = User::factory()->create();
        $business = Business::factory()->make();

        $response = $this->actingAs($user)->postJson('api/v1/utilizator/' . $user->id . '/inregistrare/business', array_merge($business->toArray(), ['user' => $user->toArray()]));

        $response->assertStatus(200);
        $businessData = $array = collect($business->toArray())->except(['email_verified_at', 'password'])->toArray();

        $response->assertJsonFragment($businessData);

        $this->assertDatabaseHas('businesses', [
            'name' => $business->name,
            'slogan' => $business->slogan,
            'short_description' => $business->short_description,
            'city' => $business->city,
            'district' => $business->district,
            'address' => $business->address,
            'profile_picture_url' => $business->profile_picture_url,
            'cover_photo_url' => $business->cover_photo_url,
            'phone' => $business->phone,
            'email' => $business->email,
            'website_url' => $business->website_url,
            'fiscal_attribute' => $business->fiscal_attribute,
            'identification_code' => $business->identification_code,
            'control_digit' => $business->control_digit,
            'registration_prefix' => $business->registration_prefix,
            'county_code' => $business->county_code,
            'order_number' => $business->order_number,
            'registration_year' => $business->registration_year,
        ]);
    }

    public function testCannotCreateBusinessWhenUserHasBusiness(): void
    {
        $existentBusiness = Business::factory()->create();
        $business = Business::factory()->make();

        $user = User::factory()->create([
            'business_id' => $existentBusiness->id,
        ]);

        $response = $this->actingAs($user)->postJson('api/v1/utilizator/' . $user->id . '/inregistrare/business', array_merge($business->toArray(), ['user' => $user->toArray()]));
        
        $response->assertStatus(422);
        $response->assertJsonFragment(['message' => 'User already has a business']);
    }

}