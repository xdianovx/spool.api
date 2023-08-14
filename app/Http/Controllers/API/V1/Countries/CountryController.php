<?php

namespace App\Http\Controllers\API\V1\Countries;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function getCountries()
    {
        $countries = CountryResource::collection(Country::all());
        return response()->json($countries);
    }
}
