<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyAnalyticStoreRequest;
use App\Property;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class PropertyAnalyticController extends Controller
{
    /**
     * Add or update an analytic for given property
     *
     * @param Property                     $property
     * @param PropertyAnalyticStoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Property $property, PropertyAnalyticStoreRequest $request)
    {
        try {
            $model = $property->analytics()
                              ->firstWhere('analytic_type_id', $request->input('analytic_type_id'));
            $action = $model ? 'update' : 'create';
            if ($action === 'update') {
                $model->update($request->input());
            } else {
                $model = $property->analytics()->create($request->input());
            }
        } catch (QueryException $e) {
            Log::notice($e->getMessage(), $request->input());

            return $this->reject('Failed to create property analytic. Please check input data.');
        } catch (Exception $e) {
            Log::critical($e->getMessage(), $request->input());

            return $this->reject('Failed to create property analytic.');
        }

        return $this->resolve("Property analytic {$action}d.", $model);
    }
}
