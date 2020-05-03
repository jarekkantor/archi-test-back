<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * POST request should return validation error when country is missing
     *
     * @test
     */
    public function shouldReturnValidationErrorWhenCountryIsMissing()
    {
        $data = ['suburb'  => 'Sydney', 'state' => 'NSW'];
        $response = $this->post('/api/property', $data);

        $response->assertStatus(422);
        $response->assertJson([
            'success' => false,
            'message' => 'Invalid input data.',
            'data'    => [
                'country' => ['The country field is required.'],
            ],
        ]);
    }

    /**
     * POST request should return created property when input is valid
     *
     * @test
     */
    public function shouldReturnCreatedProperty()
    {
        $data = ['suburb'  => 'Sydney', 'state' => 'NSW', 'country' => 'Australia'];
        $response = $this->post('/api/property', $data);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Property created.',
            'data'    => $data
        ]);

        $this->assertDatabaseHas('properties', $data);
    }
}
