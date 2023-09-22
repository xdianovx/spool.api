<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Country\CountryStoreRequest;
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

    public function store(CountryStoreRequest $request)
    {
        $data = $request->validated();
        Country::firstOrCreate([
            'name' => $data['name']
        ], $data);
        return redirect()->route('countries.index')->with('status', 'country-created');
    }

    public function update(CountryUpdateRequest $request, $country_id)
    {
        $country = Country::whereId($country_id)->firstOrFail();
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
        if (request('search') == null) :
            $countries = Country::orderBy('id', 'DESC')->paginate(10);
        else :
            $countries = Country::where('name', 'ilike', '%' . request('search') . '%')->orWhere('flag', 'ilike', '%' . request('search') . '%')->paginate(10);
        endif;
        return view('countries.index', compact('countries'));
    }
}
