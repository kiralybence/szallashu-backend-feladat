<?php

namespace Tests\Feature\Company;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    private $company;

    protected function setUp(): void
    {
        parent::setUp();

        $this->company = Company::factory()->create();
    }

    /**
     * Test if the user can fetch a certain company from the database.
     *
     * @test
     */
    public function user_can_show_companies(): void
    {
        $response = $this->getJson(route('companies.show', [
            'company' => $this->company->companyId,
        ]));

        $response
            ->assertStatus(200)
            ->assertJson($this->company->toArray());
    }
}
