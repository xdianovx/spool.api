<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartnersCompany\PartnersCompanyCrateRequest;
use App\Http\Requests\PartnersCompany\PartnersCompanyUpdateRequest;
use App\Models\Partners_company;
use Illuminate\Http\Request;

class PartnersCompanyController extends Controller
{
    public function index()
    {
        $partners_companies = Partners_company::orderBy('id', 'DESC')->get();
        return view('partners_companies.index', compact('partners_companies'));
    }

    public function create()
    {

        return view('partners_companies.create');
    }

    public function show(Partners_company $partners_company)
    {
        return view('partners_companies.show', compact('partners_company'));
    }
    
    public function edit(Partners_company $partners_company)
    { 

        return view('partners_companies.edit', compact('partners_company'));
    }

    public function store(PartnersCompanyCrateRequest $request)
    {
       
        $data = $request->validated();
        Partners_company::firstOrCreate([
            'name' => $data['name']
        ],$data);
        return redirect()->route('partners_companies.index')->with('status', 'partners_company-created');
    }

    public function update(PartnersCompanyUpdateRequest $request, Partners_company $partners_company)
    {
        $data = $request->validated();
        $partners_company->update($data);
        return redirect()->route('partners_companies.index')->with('status', 'partners_company-updated');
    }
    public function destroy(Partners_company $partners_company)
    {
        $partners_company->delete();
        return redirect()->route('partners_companies.index')->with('status', 'partners_company-deleted');
    }

    public function search(Request $request)
    {
        if (request('search')) {
            $partners_companies = Partners_company::where('name', 'like', '%' . request('search') . '%')->
            orWhere('id', 'like', '%' . request('search') . '%')->get();
        } else {
            $partners_companies = Partners_company::all();
        }
        return view('partners_companies.index', compact('partners_companies'));
    }
}
