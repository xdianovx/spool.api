<?php

namespace App\Http\Controllers\API\V1\Clients;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Models\Client;
use App\Models\ClientCard;
use App\Models\Country;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Validator;

use function PHPUnit\Framework\isNull;

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
        $client = Client::findOrFail(auth('api')->user('api')->id);
        if (!empty($client->avatar_image)) :
            $avatar = null;
            elase:
            $avatar = env('API_URL') . Storage::url($client->avatar_image);
        endif;
        if (!is_null($client->country()->first())) :
            $country = new CountryResource($client->country()->first());
        else :
            $country = null;
        endif;
        return response()->json([
            'id' => $client->id,
            'name' => $client->name,
            'age' => $client->age,
            'gender' => $client->gender,
            'avatar' => $avatar,
            'email' => $client->email,
            'phone' => $client->phone_number,
            'created_at' => $client->created_at,
            'updated_at' => $client->updated_at,
            'country' => $country
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
        $client = Client::where('id', auth('api')->user()->id)->first();
        $client->update($validator->validated());

        return response()->json([
            'message' => 'success',
            'email' => $client->email,
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

        $client = Client::where('id', auth('api')->user('api')->id)->first();
        $client->update($validator->validated());
        if (!is_null($client->country()->first())) :
            $country = new CountryResource($client->country()->first());
        else :
            $country = null;
        endif;
        return response()->json([
            'message' => 'success',
            'country' => $country
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
        $client = Client::where('id', auth('api')->user('api')->id)->first();
        $client->update($validator->validated());

        return response()->json([
            'message' => 'success',
            'name' => $client->name,
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
        $client = Client::where('id', auth('api')->user('api')->id)->first();
        $client->update($validator->validated());

        return response()->json([
            'message' => 'success',
            'age' => $client->age,
        ], 200);
    }
    public function profileGender(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'gender' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $client = Client::where('id', auth('api')->user('api')->id)->first();
        $client->update($validator->validated());

        return response()->json([
            'message' => 'success',
            'gender' => $client->gender,
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

        $client = Client::where('id', auth('api')->user('api')->id)->first();
        $client->update($validator->validated());

        return response()->json([
            'message' => 'success',
            'phone_number' => $client->phone_number,
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
            $filename = str_replace(' ', '_', $filename);
            // Расширение
            $extention = $request->file('avatar_image')->getClientOriginalExtension();
            // Путь для сохранения
            $fileNameToStore = "avatar_image/" . $filename . "_" . time() . "." . $extention;
            // Сохраняем файл
            $path = $request->file('avatar_image')->storeAs('public', $fileNameToStore);
        }

        $client = Client::where('id', auth('api')->user('api')->id);
        $client->update(['avatar_image' => $path]);

        return response()->json([
            'message' => 'success',
            'avatar_image' => env('API_URL') . Storage::url($client->value('avatar_image')),
        ], 200);
    }

    public function profileCards(Request $request)
    {
        $client = Client::where('id', auth('api')->user('api')->id)->first();
        return response()->json($client->cards);
    }
    public function destroy($card_id)
    {
        try {
            $card = ClientCard::findorfail($card_id);
            $card->delete();
            return response()->json([
                'message' => 'card deleted',
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'status' => 'failed',
                'error' => 'Card not found'
            ], 404);
        }
    
    }
}
