<?php

namespace Tests\Feature\Company;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    private $company;

    protected function setUp(): void
    {
        parent::setUp();

        $this->company = Company::factory()->create();
    }

    /**
     * Test if the user can update an existing company in the database.
     *
     * @test
     */
    public function user_can_update_companies(): void
    {
        $inputs = Company::factory()->make([
            'companyFoundationDate' => $this->company->companyFoundationDate, // this should not be changed
        ])->toArray();

        $response = $this->putJson(route('companies.update', array_merge(
            ['company' => $this->company->companyId],
            $inputs,
        )));

        $response
            ->assertStatus(200)
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
        $response = $this->putJson(route('companies.update', [
            'company' => $this->company->companyId,
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
