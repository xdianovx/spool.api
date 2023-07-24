<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryUpdateRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('countries.index', compact('countries'));
    }
    public function show(Country $country)
    {
        return view('countries.show', compact('country'));
    }
    public function edit(CountryUpdateRequest $request, Country $country)
    {
        $data = $request->validated();
        $country->update($data);
        return view('countries.edit', compact('country'));
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->back();
    }
}
