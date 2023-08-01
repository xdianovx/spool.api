<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Country\CountryCrateRequest;
use App\Http\Requests\Country\CountryUpdateRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('id', 'DESC')->paginate(10);
        return view('countries.index', compact('countries'));
    }

    public function create()
    {

        return view('countries.create');
    }

    public function show(Country $country)
    {
        return view('countries.show', compact('country'));
    }
    
    public function edit(Country $country)
    { 

        return view('countries.edit', compact('country'));
    }

    public function store(CountryCrateRequest $request)
    {
        $data = $request->validated();
        Country::firstOrCreate([
            'name' => $data['name']
        ],$data);
        return redirect()->route('countries.index')->with('status', 'country-created');
    }

    public function update(CountryUpdateRequest $request, Country $country)
    {
        $data = $request->validated();
        $country->update($data);
        return redirect()->route('countries.index')->with('status', 'country-updated');
    }
    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('countries.index')->with('status', 'country-deleted');
    }

    public function search(Request $request)
    {
        if (request('search' == 'null')):
            $countries = Country::all();
        else:
            $countries = Country::where('name', 'like', '%' . request('search') . '%')->
            orWhere('id', 'like', '%' . request('search') . '%')->paginate(10);
        endif;
        return view('countries.index', compact('countries'));
    }

}
