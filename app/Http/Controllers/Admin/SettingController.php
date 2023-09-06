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

    public function show(Setting $setting)
    {
        return view('settings.show', compact('setting'));
    }
    
    public function edit(Setting $setting)
    { 
        return view('settings.edit', compact('setting'));
    }

    public function store(SettingStoreRequest $request)
    {
        $data = $request->validated();
        Setting::firstOrCreate($data);
        return redirect()->route('settings.index')->with('status', 'setting-created');
    }

    public function update(SettingUpdateRequest $request, $setting_id)
    {
        $setting = Setting::whereId($setting_id)->firstOrFail();
        $data = $request->validated();
        $setting->update($data);
        return redirect()->route('settings.index')->with('status', 'setting-updated');
    }
    public function destroy(Setting $setting)
    { 
        $setting->delete();
        return redirect()->route('settings.index')->with('status', 'setting-deleted');
    }

    public function search(Request $request)
    {
        if (request('search') == null):
            $settings = Setting::orderBy('id', 'DESC')->paginate(10);
        else:
            $settings = Setting::where('key', 'ilike', '%' . request('search') . '%')->
            orWhere('value', 'ilike', '%' . request('search') . '%')->paginate(10);
        endif;
        return view('settings.index', compact('settings'));
    }
}
