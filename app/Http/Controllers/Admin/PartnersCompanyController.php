<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartnersCompany\PartnersCompanyStoreRequest;
use App\Http\Requests\PartnersCompany\PartnersCompanyUpdateRequest;
use App\Models\Partners_company;
use Illuminate\Http\Request;

class PartnersCompanyController extends Controller
{
    public function index()
    {
        $partners_companies = Partners_company::orderBy('id', 'DESC')->paginate(10);
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

    public function store(PartnersCompanyStoreRequest $request)
    {
       
        $data = $request->validated();
        Partners_company::firstOrCreate([
            'name' => $data['name']
        ],$data);
        return redirect()->route('partners_companies.index')->with('status', 'partners_company-created');
    }

    public function update(PartnersCompanyUpdateRequest $request, $partners_company_id)
    {
        $partners_company = Partners_company::whereId($partners_company_id)->firstOrFail();
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
        if (request('search') == null):
            $partners_companies = Partners_company::orderBy('id', 'DESC')->paginate(10);
        else:
            $partners_companies = Partners_company::where('name', 'ilike', '%' . request('search') . '%')->
            orWhere('id', 'ilike', '%' . request('search') . '%')->paginate(10);
        endif;
        return view('partners_companies.index', compact('partners_companies'));
    }
}
