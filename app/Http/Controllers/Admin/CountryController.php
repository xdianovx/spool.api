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

    public function show($country)
    {
        $country = Country::whereId($country)->firstOrFail();
        return view('countries.show', compact('country'));
    }
    
    public function edit($country)
    { 
        $country = Country::whereId($country)->firstOrFail();
        return view('countries.edit', compact('country'));
    }

    public function store(CountryStoreRequest $request)
    {
        $data = $request->validated();
        Country::firstOrCreate([
            'name' => $data['name']
        ],$data);
        return redirect()->route('countries.index')->with('status', 'country-created');
    }

    public function update(CountryUpdateRequest $request, $country)
    {
        $country = Country::whereId($country)->firstOrFail();
        $data = $request->validated();
        $country->update($data);
        return redirect()->route('countries.index')->with('status', 'country-updated');
    }
    public function destroy($country)
    {
        $country = Country::whereId($country)->firstOrFail();
        $country->delete();
        return redirect()->route('countries.index')->with('status', 'country-deleted');
    }

    public function search(Request $request)
    {
        if (request('search') == null):
            $countries = Country::orderBy('id', 'DESC')->paginate(10);
        else:
            $countries = Country::where('name', 'like', '%' . request('search') . '%')->
            orWhere('flag', 'like', '%' . request('search') . '%')->paginate(10);
        endif;
        return view('countries.index', compact('countries'));
    }

}
