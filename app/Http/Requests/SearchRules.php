<?php

namespace App\Http\Requests;

trait SearchRules
{
    /**
     * Search request validation rules
     * 
     */
    public function validation()
    {
        $validation = [
            'doesntHave' => 'sometimes|required|array',
            'descending' => 'sometimes|required|bool',
            'first' => 'sometimes|required|bool',
            'has' => 'sometimes|required|array',
            'inverse' => 'sometimes|required|bool',
            'null' => 'sometimes|required|bool',
            'orderBy' => 'sometimes|required_with:descending|required',
            'orderBy.*.column' => 'sometimes|required|string',
            'orderBy.*.descending' => 'sometimes|required|bool',
            'onlyTrashed' => 'sometimes|required|bool',
            'page' => 'sometimes|required|numeric',
            'perPage' => 'required_with:page|numeric',
            'strict' => 'sometimes|required|bool',
            'with' => 'sometimes|required|array',
            'withCount' => 'sometimes|required|array',
            'withTrashed' => 'sometimes|required|bool',
        ];

        if (request()->isMethod('POST')) {
            $validation['doesntHave.*.relationship'] = 'sometimes|required|string';
            $validation['doesntHave.*.where'] = 'sometimes|required|array';
            $validation['doesntHave.*.where.*.inverse'] = 'sometimes|required|bool';
            $validation['doesntHave.*.where.*.*.null'] = 'sometimes|required|bool';
            $validation['doesntHave.*.where.*.strict'] = 'sometimes|required|bool';

            $validation['has.*.greaterThan'] = 'sometimes|required|numeric';
            $validation['has.*.greaterThanEqualTo'] = 'sometimes|required|numeric';
            $validation['has.*.lessThan'] = 'sometimes|required|numeric';
            $validation['has.*.lessThanEqualTo'] = 'sometimes|required|numeric';
            $validation['has.*.relationship'] = 'sometimes|required|string';
            $validation['has.*.where'] = 'sometimes|required|array';
            $validation['has.*.where.*.inverse'] = 'sometimes|required|bool';
            $validation['has.*.where.*.*.null'] = 'sometimes|required|bool';
            $validation['has.*.where.*.strict'] = 'sometimes|required|bool';

            $validation['where'] = 'sometimes|required|array';
            $validation['where.*.inverse'] = 'sometimes|required|bool';
            $validation['where.*.*.null'] = 'sometimes|required|bool';
            $validation['where.*.strict'] = 'sometimes|required|bool';

            $validation['with.*.descending'] = 'sometimes|required|bool';
            $validation['with.*.orderBy'] = 'sometimes|required';
            $validation['with.*.orderBy.*.column'] = 'sometimes|required|string';
            $validation['with.*.orderBy.*.descending'] = 'sometimes|required|bool';

            $validation['with.*.where'] = 'sometimes|required|array';
            $validation['with.where.*.inverse'] = 'sometimes|required|bool';
            $validation['with.where.*.*.null'] = 'sometimes|required|bool';
            $validation['with.where.*.strict'] = 'sometimes|required|bool';

            $validation['withCount.*.where'] = 'sometimes|required|array';
            $validation['withCount.where.*.inverse'] = 'sometimes|required|bool';
            $validation['withCount.where.*.*.null'] = 'sometimes|required|bool';
            $validation['withCount.where.*.strict'] = 'sometimes|required|bool';
        }

        return $validation;
    }
}
