<?php

namespace Tests\Feature;

use App\AnalyticType;
use App\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyAnalyticControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * POST request should return 404 error when property id is invalid
     *
     * @test
     */
    public function shouldReturn404ErrorWhenPropertyIdIsInvalid()
    {
        $data = ['analytic_type_id' => 1, 'value' => 200];
        $response = $this->post('/api/property/1/analytic', $data);

        $response->assertStatus(404);
        $response->assertJson([
            'success' => false,
            'message' => 'Not found.',
        ]);
    }

    /**
     * POST request should return validation error when analytic type id is invalid
     *
     * @test
     */
    public function shouldReturnValidationErrorWhenAnalyticTypeIdIsInvalid()
    {
        $property = factory(Property::class)->create();

        $data = ['analytic_type_id' => 1, 'value' => 200];
        $response = $this->post("/api/property/{$property->id}/analytic", $data);

        $response->assertStatus(422);
        $response->assertJson([
            'success' => false,
            'message' => 'Invalid input data.',
            'data'    => [
                'analytic_type_id' => ['The selected analytic type id is invalid.'],
            ],
        ]);
    }

    /**
     * POST request should return validation error when analytic_type_id is missing
     *
     * @test
     */
    public function shouldReturnValidationErrorWhenAnalyticTypeIdIsMissing()
    {
        $property = factory(Property::class)->create();

        $data = ['value' => 200];
        $response = $this->post("/api/property/{$property->id}/analytic", $data);

        $response->assertStatus(422);
        $response->assertJson([
            'success' => false,
            'message' => 'Invalid input data.',
            'data'    => [
                'analytic_type_id' => ['The analytic type id field is required.'],
            ],
        ]);
    }

    /**
     * POST request should return created property analytic when input is valid
     *
     * @test
     */
    public function shouldReturnCreatedPropertyAnalytic()
    {
        $property = factory(Property::class)->create();
        $type = factory(AnalyticType::class)->create();

        $data = ['analytic_type_id' => $type->id, 'value' => 200];
        $response = $this->post("/api/property/{$property->id}/analytic", $data);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Property analytic created.',
            'data'    => $data
        ]);

        $this->assertDatabaseHas('property_analytics', $data);
    }
}
