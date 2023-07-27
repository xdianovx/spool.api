<?php

namespace App\Http\Controllers\API\V1\Clients;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientsTemporaryPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
        $this->middleware('auth:api', ['except' => ['login', 'login_confirm']]);
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:clients',
        ]);
        if ($validator->fails()):
            if($validator->messages()->first('email', ':message') == "The email has already been taken."):
                $client_id = Client::where('email', $request->email)->value('id');
                if(Carbon::parse(ClientsTemporaryPassword::where('clients_temporary_password_id', $client_id)->value('updated_at'))->lt(Carbon::now()->subMinutes(1440))):
                    $comb = "abcdefghijklmnopqrstuvwxyz";
                    $shfl = str_shuffle($comb);
                    $password = substr($shfl,0,15);
                    $password = mb_substr($password, 0, 5) . '-' . mb_substr($password,5, 5) . '-' . mb_substr($password, 10);
                    $password_hashe = Hash::make($password);
                    ClientsTemporaryPassword::where('clients_temporary_password_id', $client_id)->update(['password' => $password_hashe]);
                    Client::where('id', $client_id)->update(['password' => $password_hashe]);
                    $client_email = Client::where('id', $client_id)->value('email');
                    return response()->json([
                        'message' => 'success',
                        'password' => $password,
                        'email' => $client_email
                        // 'message' => 'We have sent the password to your email '.$client->email.'',
                        // 'client' => $client
                    ], 200);
                    else :
                        $client_email = Client::where('id', $client_id)->value('email');
                        return response()->json([
                            'message' => 'success',
                            'password' => 'Enter the last password that was sent to your email.',
                            'email' => $client_email
                            // 'message' => 'We have sent the password to your email '.$client->email.'',
                            // 'client' => $client
                        ], 200);
                endif;
            endif;
            return response()->json($validator->errors(), 422);
        endif;
        $client = Client::create(array_merge(
            $validator->validated()
        )); 
        $comb = "abcdefghijklmnopqrstuvwxyz";
        $shfl = str_shuffle($comb);
        $password = substr($shfl,0,15);
        $password =  mb_substr($password, 0, 5) . '-' . mb_substr($password,5, 5) . '-' . mb_substr($password, 10);
        $password_hashe = Hash::make($password);
        $clients_temporary_password = ClientsTemporaryPassword::create(array_merge([
            'password' => $password_hashe,
            'clients_temporary_password_id' => $client->id,
        ]));
        $client->update([
            'password' => $password_hashe,
        ]);

        return response()->json([
            'message' => 'success',
            'password' => $password,
            'email' => $client->email
            // 'message' => 'We have sent the password to your email '.$client->email.'',
            // 'client' => $client
        ], 200);
    }

    public function login_confirm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:17',
        ]);
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
        $client_id = Client::where('id', auth()->user()->id)->value('id');
        Client::where('id', $client_id)->update([
            'name' => $request['name'],
            'age' => $request['age'],
        ]);
        $client_email = Client::where('id', $client_id)->value('email');
        $client_name = Client::where('id', $client_id)->value('name');
        $client_age = Client::where('id', $client_id)->value('age');
        return response()->json([
            'message' => 'success',
            'name' => $client_name,
            'email' => $client_email,
            'age' => $client_age
            // 'message' => 'We have sent the password to your email '.$client->email.'',
            // 'client' => $client
        ], 200);
  
    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'client successfully signed out']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth('api')->refresh());
    }
    /**
     * Get the authenticated client.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth()->user('api'));
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'client' => auth()->user('api')
        ]);
    }
}
