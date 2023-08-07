<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdatePasswordRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\Partners_company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $partner_companies = Partners_company::all();
        return view('users.create',compact('partner_companies'));
    }

    public function show($user)
    {
        $user = User::whereId($user)->firstOrFail();
        return view('users.show', compact('user'));
    }
    
    public function edit($user)
    { 
        $user = User::whereId($user)->firstOrFail();
        $partner_companies = Partners_company::all();
        return view('users.edit', compact('user', 'partner_companies'));
    }

    public function store(UserStoreRequest $request)
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

    public function update(UserUpdateRequest $request, $user)
    {
        $user = User::whereId($user)->firstOrFail();
        $data = $request->validated();
        $user->update($data);
        return redirect()->route('users.index')->with('status', 'account-updated');
    }
    public function updatePassword(UserUpdatePasswordRequest $request, $user)
    {
        $user = User::whereId($user)->firstOrFail();
        $data = $request->validated();
        $user->update($data);
        return redirect()->route('users.index')->with('status', 'account-password-updated');
    }
    public function destroy($user)
    {
        $user = User::whereId($user)->firstOrFail();
        $user->delete();
        return redirect()->route('users.index')->with('status', 'account-deleted');
    }

    public function search(Request $request)
    {
        if (request('search' == 'null')):
            $users = User::orderBy('id', 'DESC')->paginate(10);

        else:
            $users = User::where('name', 'like', '%' . request('search') . '%')->
            orWhere('id', 'like', '%' . request('search') . '%')->
            orWhere('email', 'like', '%' . request('search') . '%')->
            orWhere('role', 'like', '%' . request('search') . '%')->paginate(10);
        endif;
        return view('users.index', compact('users'));
    }
}
