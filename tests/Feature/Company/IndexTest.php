<?php

namespace Tests\Feature\Company;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the user can list out all companies in the database.
     *
     * @test
     */
    public function user_can_index_companies(): void
    {
        $response = $this->getJson(route('companies.index'));

        $response
            ->assertStatus(200)
            ->assertJson(Company::all()->toArray());
    }

    /**
     * Test if the user can filter companies with the companyIds parameter.
     *
     * @test
     */
    public function user_can_index_companies_with_companyids_filter(): void
    {
        $companies = Company::factory()->count(3)->create();

        $response = $this->getJson(route('companies.index', [
            'companyIds' => $companies->pluck('companyId')->toArray(),
        ]));

        $response
            ->assertStatus(200)
            ->assertJson($companies->toArray());
    }

    /**
     * Test for validation errors.
     *
     * @test
     * @dataProvider dataProvider
     */
    public function validation_errors($key, $value): void
    {
        $response = $this->getJson(route('companies.index', [
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
            'companyIds is not an array' => ['companyIds', 'not-an-array'],
        ];
    }
}
