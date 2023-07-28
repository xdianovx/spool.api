<?php

namespace App\Http\Controllers\API\V1\Countries;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function getCountry()
    {
        $countries = Country::all();
        return response()->json($countries);
    }
}
