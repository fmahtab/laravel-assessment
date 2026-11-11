<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $request->validate(
            [
                'page_size' => 'sometimes|integer|min:1|max:100',
            ]
        );

        $data = \App\Models\Destination::orderBy('id')
            ->paginate($request->input('page_size', 10)) //default pagesize = 10
            ->withQueryString();

        return response()->json($data);
    }

}
