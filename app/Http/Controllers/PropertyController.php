<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyStoreRequest;
use App\Property;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
    public function store(PropertyStoreRequest $request, Property $property)
    {
        try {
            $model = $property->create($request->input());
        } catch (QueryException $e) {
            Log::notice($e->getMessage(), $request->input());

            return $this->resolve('Failed to create property. Please check input data.');
        } catch (Exception $e) {
            Log::critical($e->getMessage(), $request->input());

            return $this->resolve('Failed to create property.');
        }

        return $this->resolve('Property created.', $model);
    }
}
