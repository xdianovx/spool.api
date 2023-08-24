<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\SettingStoreRequest;
use App\Http\Requests\Setting\SettingUpdateRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::orderBy('id', 'DESC')->paginate(10);
        return view('settings.index', compact('settings'));
    }

    public function create()
    {

        return view('settings.create');
    }

    public function show($setting)
    {
        $setting = Setting::whereId($setting)->firstOrFail();
        return view('settings.show', compact('setting'));
    }
    
    public function edit($setting)
    { 
        $setting = Setting::whereId($setting)->firstOrFail();
        return view('settings.edit', compact('setting'));
    }

    public function store(SettingStoreRequest $request)
    {
        $data = $request->validated();
        Setting::firstOrCreate($data);
        return redirect()->route('settings.index')->with('status', 'setting-created');
    }

    public function update(SettingUpdateRequest $request, $setting)
    {
        $setting = Setting::whereId($setting)->firstOrFail();
        $data = $request->validated();
        $setting->update($data);
        return redirect()->route('settings.index')->with('status', 'setting-updated');
    }
    public function destroy($setting)
    {
        $setting = Setting::whereId($setting)->firstOrFail();
        $setting->delete();
        return redirect()->route('settings.index')->with('status', 'setting-deleted');
    }

    public function search(Request $request)
    {
        if (request('search') == null):
            $settings = Setting::orderBy('id', 'DESC')->paginate(10);
        else:
            $settings = Setting::where('key', 'like', '%' . request('search') . '%')->
            orWhere('value', 'like', '%' . request('search') . '%')->paginate(10);
        endif;
        return view('settings.index', compact('settings'));
    }
}
