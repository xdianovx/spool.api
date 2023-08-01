<?php

namespace App\Http\Controllers\API\V1\Clients;

use App\Events\Auth\ClientRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Client;
use App\Models\ClientsTemporaryPassword;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['jwt.verify'], ['except' => ['login', 'login_confirm','refresh']]);
    }

    public function login(Request $request)
    {
        $this->headers_check($request);
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:clients',
        ]);
        if ($validator->fails()) :
            if ($validator->messages()->first('email', ':message') == "The email has already been taken.") :
                $client = Client::where('email', $request->email);
                $client_id = $client->value('id');
                $password = $this->password_generate();
                $password_hashe = Hash::make($password);
                ClientsTemporaryPassword::where('clients_temporary_password_id', $client_id)->update(['password' => $password_hashe]);
                Client::where('id', $client_id)->update(['password' => $password_hashe]);
                event(new ClientRegistered(Client::find($client->value('id')), $password));  // Sending password
                    return response()->json([
                        'message' => 'The password has been sent to your email.',
                        'password' => $password,
                        'email' => $client->value('email')
                    ], 200);

            endif;
            return response()->json($validator->errors(), 422);
        endif;
        $client = Client::create(array_merge(
            $validator->validated()
        ));
        $password = $this->password_generate();
        $password_hashe = Hash::make($password);
        $clients_temporary_password = ClientsTemporaryPassword::create(array_merge([
            'password' => $password_hashe,
            'clients_temporary_password_id' => $client->id,
        ]));
        $client->update([
            'password' => $password_hashe,
        ]);

        event(new ClientRegistered($client, $password)); // Sending password
        
        return response()->json([
            'message' => 'The password has been sent to your email.',
            'password' => $password,
            'email' => $client->email
        ], 200);
    }

    public function login_confirm(LoginRequest $request)
    {
        $this->headers_check($request);
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:17|',
        ]);
        $client_id = Client::where('email', $request->email)->value('id');
        if (Carbon::parse(ClientsTemporaryPassword::where('clients_temporary_password_id', $client_id)->value('updated_at'))->lt(Carbon::now()->subMinutes(1440))) :
            return response()->json(['message' => 'Your password has expired']);
        endif;
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth('api')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }


    public function login_profile(Request $request)
    {        
        $this->headers_check($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
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
            'name' => $client->value('name'),
            'age' => $client->value('age'),
        ], 200);
    }

    public function logout(Request $request)
    {
        $this->headers_check($request);
        Auth::guard('api')->logout();
        return response()->json(['message' => 'client successfully signed out']);
    }

    public function refresh()
    {

        return $this->createNewToken(auth('api')->refresh());
    }

    //Token

    protected function createNewToken($token)
    {
        if(auth('api')->user()):
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'is_filled' => (auth('api')->user()->name && auth('api')->user()->age) ? true : false
        ]);
    else:
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    endif;
    }

    protected function password_generate()
    {
        $comb = "abcdefghijklmnopqrstuvwxyz";
        $shfl = str_shuffle($comb);
        $password = substr($shfl, 0, 15);
        $password = mb_substr($password, 0, 5) . '-' . mb_substr($password, 5, 5) . '-' . mb_substr($password, 10);
        return $password;
    }
    protected function headers_check($request)
    {
        if (!$request->header('language')) :
            App::abort(500);
        endif;
        if (!$request->header('system')) :
            App::abort(500);
        endif;
        if (!$request->header('version')) :
            App::abort(500);
        endif;
    }
}
