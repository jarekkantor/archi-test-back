<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyAnalyticStoreRequest;
use App\Property;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class PropertyAnalyticController extends Controller
{
    public function store(Property $property, PropertyAnalyticStoreRequest $request)
    {
        try {
            $model = $property->analytics()->create($request->input());
        } catch (QueryException $e) {
            Log::notice($e->getMessage(), $request->input());

            return $this->reject('Failed to create property analytic. Please check input data.');
        } catch (Exception $e) {
            Log::critical($e->getMessage(), $request->input());

            return $this->reject('Failed to create analytic.');
        }

        return $this->resolve('Property analytic created.', $model);
    }
}
