<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
        public function index(Request $request)
        {
            $countries = Country::select('id', 'name')->orderBy('name', 'ASC');
            if ($request->q) {
                $countries = $countries->where('name', 'LIKE', "%$request->q%");
            }
            return response()->json([
                'countries' => $countries->get()->map(function ($country) {

                    return ['id' => $country->id, 'text' => $country->name];
                })
            ], 200);
        }

}
