<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnalyticSummaryShowRequest;
use App\PropertyAnalytic;

class AnalyticSummaryController extends Controller
{
    /**
     * Get a summary of all property analytics for given area
     *
     * @param string                     $area suburb|state|country
     * @param string                     $name
     * @param AnalyticSummaryShowRequest $request
     * @param PropertyAnalytic           $analytic
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(
        string $area,
        string $name,
        // $request is required to validate $area
        AnalyticSummaryShowRequest $request,
        PropertyAnalytic $analytic
    ) {
        $all = $analytic->isNumeric()->allPerArea($area, $name)->get();
        $summary = [];
        $total = $all->count();
        $lists = $all->groupBy('analytic_type_id');
        // TODO: consider using SQL to calculate below figures to improve performance
        foreach ($lists as $id => $list) {
            $withValue = floor($list->count() / $total * 100);
            $type = $list[0]->analyticType;
            $summary[] = [
                'name'                  => $type->name,
                'units'                 => $type->units,
                'min'                   => number_format($list->min('value'), $type->num_decimal_places),
                'max'                   => number_format($list->max('value'), $type->num_decimal_places),
                'median'                => number_format($list->median('value'), $type->num_decimal_places),
                'percent_with_value'    => $withValue,
                'percent_without_value' => 100 - $withValue,
            ];
        }

        return $this->resolve("Property analytics summary for $area $name.", $summary);
    }
}
