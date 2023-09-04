<?php
namespace App\Http\Middleware;


use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;


class JwtMiddleware extends BaseMiddleware
{


	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

		try {
		   $user = FacadesJWTAuth::parseToken()->authenticate();
 		} catch (Exception $e) {
        	  if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
		    return response()->json(['status' => 'Токен недействителен'], 403);
		  }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
			return response()->json(['status' => 'Срок действия токена истек'], 401);
		  }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException){
			return response()->json(['status' => 'Токен занесен в черный список'], 400);
		  }else{
		        return response()->json(['status' => 'Токен авторизации не найден'], 404);
		  }
		}
            return $next($request);
	}
}

