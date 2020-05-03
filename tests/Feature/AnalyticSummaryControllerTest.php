<?php

namespace Tests\Feature;

use App\AnalyticType;
use App\Property;
use App\PropertyAnalytic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnalyticSummaryControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * GET request should return validation error when area is invalid
     *
     * @test
     */
    public function shouldReturnValidationErrorWhenAreaIsInvalid()
    {
        $response = $this->get('/api/summary/city/Sydney');

        $response->assertStatus(422);
        $response->assertJson(
            [
                'success' => false,
                'message' => 'Invalid input data.',
                'data'    => [
                    'area' => ['The selected area is invalid.'],
                ],
            ]
        );
    }

    /**
     * GET request should return summary of all property analytics for given area
     *
     * @test
     */
    public function shouldReturnSummaryOfPropertyAnalytic()
    {
        $area = 'suburb';
        $name = 'Sydney';

        $type = factory(AnalyticType::class)->create(['is_numeric' => true]);
        $property1 = factory(Property::class)->create([$area => $name]);
        $property2 = factory(Property::class)->create([$area => $name]);
        $property3 = factory(Property::class)->create([$area => $name]);

        $property1->analytics()->create(['analytic_type_id' => $type->id, 'value' => 100]);
        $property2->analytics()->create(['analytic_type_id' => $type->id, 'value' => 200]);
        $property3->analytics()->create(['analytic_type_id' => $type->id, 'value' => 300]);

        $response = $this->get("/api/summary/$area/$name");

        $list = PropertyAnalytic::all();
        $withValue = floor($list->count() / $list->count() * 100);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => "Property analytics summary for $area $name.",
            'data'    => [
                [
                    'name'                  => $type->name,
                    'units'                 => $type->units,
                    'min'                   => number_format($list->min('value'), $type->num_decimal_places),
                    'max'                   => number_format($list->max('value'), $type->num_decimal_places),
                    'median'                => number_format($list->median('value'), $type->num_decimal_places),
                    'percent_with_value'    => $withValue,
                    'percent_without_value' => 100 - $withValue,
                ],
            ],
        ]);
    }
}
