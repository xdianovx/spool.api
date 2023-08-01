<?php
namespace App\Http\Middleware;


use Closure;
use Exception;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
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
		   $user = JWTAuth::parseToken()->authenticate();
 		} catch (Exception $e) {
        	  if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
		    return response()->json(['status' => 'Token is Invalid'], 403);
		  }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
			try
			{
			  $refreshed = JWTAuth::refresh(JWTAuth::getToken());
			  $user = JWTAuth::setToken($refreshed)->toUser();
			  $request->headers->set('Authorization','Bearer '.$refreshed);
			}catch (JWTException $e){
				return response()->json([
					'code'   => 103,
					'message' => 'Token cannot be refreshed, please Login again'
				]);
			}
		}else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
			return response()->json(['status' => 'Token is Expired'], 401);
		  }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException){
			return response()->json(['status' => 'Token is Blacklisted'], 400);
		  }else{
		        return response()->json(['status' => 'Authorization Token not found'], 404);
		  }
		}
            return $next($request);
	}
}

