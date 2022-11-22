<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::all();
        return response([ 'collections' => $collections, 'message' => 'Retrieved successfully'], 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => ['required']
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $collection = Collection::create($data);

        return response([ 'collection' => $collection, 'message' => 'Created successfully'], 200);
    }

    public function destroy(Collection $collection)
    {
        $collection->delete();
        return response(['message' => 'Deleted']);
    }
}
