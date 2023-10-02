<?php

namespace App\Http\Controllers\API\V1\Settings;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
        /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }
    public function getSettings()
    {
        $settings = SettingResource::collection(Setting::all());
        return response()->json($settings);
    }
}
