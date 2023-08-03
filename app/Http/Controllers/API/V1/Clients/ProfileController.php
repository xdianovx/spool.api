<?php

namespace App\Http\Controllers\API\V1\Clients;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Country;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Validator;

class ProfileController extends Controller
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
    //Profile

    public function userProfile(Request $request)
    {
  
        $avatar = null;
        $client = Client::find(auth('api')->user('api')->id);
        if (!empty($client->avatar_image)) :
            $avatar = null;
            elase:
            $avatar = env('API_URL') . Storage::url($client->avatar_image);
        endif;
        $client = Client::where('id', auth('api')->user('api')->id);
        return response()->json([
            'id' => $client->value('id'),
            'name' => $client->value('name'),
            'age' => $client->value('age'),
            'gender' => $client->value('gender'),
            'avatar' => $avatar,
            'blocked_at' => $client->value('blocked_at'),
            'email' => $client->value('email'),
            'phone' => $client->value('phone_number'),
            'last_login_date' => $client->value('last_login_date'),
            'email_verified_at' => $client->value('email_verified_at'),
            'created_at' => $client->value('created_at'),
            'updated_at' => $client->value('updated_at'),
            'country' => [
                'id' => $client->value('id'),
                'country' => Client::find(auth('api')->user()->id)->country->name ?? "null"
            ]

        ], 200);
    }

    public function profileEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:clients',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $client = Client::where('id', auth('api')->user()->id);
        $client_id = $client->value('id');
        Client::where('id', $client_id)->update($validator->validated());
        return response()->json([
            'message' => 'success',
            'email' => $client->value('email'),
        ], 200);
    }

    public function profilePostCountry(Request $request)
    {
  
        $validator = Validator::make($request->all(), [
            'country_id' => 'required|integer|min:1',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $client = Client::where('id', auth('api')->user()->id);
        $client_id = $client->value('id');
        Client::where('id', $client_id)->update($validator->validated());
        return response()->json([
            'message' => 'success',
            'country' => Client::find(auth('api')->user()->id)->country->name ?? "null"
        ], 200);
    }

    public function profileName(Request $request)
    {
  
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $client = Client::where('id', auth('api')->user()->id);
        $client_id = $client->value('id');
        Client::where('id', $client_id)->update($validator->validated());
        return response()->json([
            'message' => 'success',
            'name' => $client->value('name'),
        ], 200);
    }

    public function profileAge(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'age' => 'required|integer|min:1',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $client = Client::where('id', auth('api')->user()->id);
        $client_id = $client->value('id');
        Client::where('id', $client_id)->update($validator->validated());
        return response()->json([
            'message' => 'success',
            'age' => $client->value('age'),
        ], 200);
    }

    public function profilePhone(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'phone_number' => ['min:10', 'required', 'numeric', 'unique:clients']
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $client = Client::where('id', auth('api')->user()->id);
        $client_id = $client->value('id');
        Client::where('id', $client_id)->update($validator->validated());
        return response()->json([
            'message' => 'success',
            'phone_number' => $client->value('phone_number'),
        ], 200);
    }

    public function profileAvatar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar_image' => 'image|required|max:1999',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Если есть файл
        if ($request->hasFile('avatar_image')) {
            // Имя и расширение файла
            $filenameWithExt = $request->file('avatar_image')->getClientOriginalName();
            // Только оригинальное имя файла
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = str_replace(' ','_',$filename);
            // Расширение
            $extention = $request->file('avatar_image')->getClientOriginalExtension();
            // Путь для сохранения
            $fileNameToStore = "avatar_image/" . $filename . "_" . time() . "." . $extention;
            // Сохраняем файл
            $path = $request->file('avatar_image')->storeAs('public', $fileNameToStore);
        }
        $client = Client::where('id', auth('api')->user()->id);
        $client->update(['avatar_image' => $path]);
        return response()->json([
            'message' => 'success',
            'avatar_image' => env('API_URL') . Storage::url($client->value('avatar_image')),
        ], 200);
    }

}
