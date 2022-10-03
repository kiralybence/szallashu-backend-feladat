<?php

namespace Tests\Feature\Company;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the user can store a new company to the database.
     *
     * @test
     */
    public function user_can_store_companies(): void
    {
        $inputs = Company::factory()->make()->toArray();

        $response = $this->postJson(route('companies.store', $inputs));

        $response
            ->assertStatus(201)
            ->assertJson($inputs);
    }

    /**
     * Test for validation errors.
     *
     * @test
     * @dataProvider dataProvider
     */
    public function validation_errors($key, $value): void
    {
        $response = $this->postJson(route('companies.store', [
            $key => $value,
        ]));

        $response->assertJsonValidationErrorFor($key);
    }

    /**
     * Provide bad inputs for validation checking.
     *
     * @return string[][]
     */
    public function dataProvider(): array
    {
        return [
            'companyName is required' => ['companyName', null],
            'companyName is too long' => ['companyName', Str::random(256)],
            'companyRegistrationNumber is required' => ['companyRegistrationNumber', null],
            'companyRegistrationNumber is too long' => ['companyRegistrationNumber', Str::random(256)],
            'companyFoundationDate is required' => ['companyFoundationDate', null],
            'companyFoundationDate is not a date' => ['companyFoundationDate', 'not-a-date'],
            'companyFoundationDate is badly formatted' => ['companyFoundationDate', now()->format('Y.m.d')],
            'country is required' => ['country', null],
            'country is too long' => ['country', Str::random(256)],
            'zipCode is required' => ['zipCode', null],
            'zipCode is too long' => ['zipCode', Str::random(256)],
            'city is required' => ['city', null],
            'city is too long' => ['city', Str::random(256)],
            'streetAddress is required' => ['streetAddress', null],
            'streetAddress is too long' => ['streetAddress', Str::random(256)],
            'latitude is required' => ['latitude', null],
            'latitude is not numeric' => ['latitude', 'not-a-number'],
            'latitude is too big' => ['latitude', 91],
            'latitude is too small' => ['latitude', -91],
            'longitude is required' => ['longitude', null],
            'longitude is not numeric' => ['longitude', 'not-a-number'],
            'longitude is too big' => ['longitude', 181],
            'longitude is too small' => ['longitude', -181],
            'companyOwner is required' => ['companyOwner', null],
            'companyOwner is too long' => ['companyOwner', Str::random(256)],
            'employees is required' => ['employees', null],
            'employees is too long' => ['employees', Str::random(256)],
            'activity is required' => ['activity', null],
            'activity is too long' => ['activity', Str::random(256)],
            'active is required' => ['active', null],
            'active is not a boolean' => ['active', 'not-a-boolean'],
            'email is required' => ['email', null],
            'email is not an email' => ['email', 'not-an-email'],
            'email is too long' => ['email', Str::random(256)],
            'password is required' => ['password', null],
            'password is too long' => ['password', Str::random(256)],
        ];
    }
}
