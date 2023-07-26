<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\User\UserCrateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\Partner_company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $partner_companies = Partner_company::all();
        return view('users.create',compact('partner_companies'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
    
    public function edit(User $user)
    { 
        $partner_companies = Partner_company::all();
        return view('users.edit', compact('user', 'partner_companies'));
    }

    public function store(UserCrateRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        User::firstOrCreate([
            'role' => $data['role'],
            'password' => $data['password'],
            'partner_company_id' => $data['partner_company_id'],
        ],$data);
        return redirect()->route('users.index')->with('status', 'account-created');
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);
        return redirect()->route('users.index')->with('status', 'account-updated');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('status', 'account-deleted');
    }
}
