<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class RefreshToken extends BaseMiddleware
{
    public function handle($request, Closure $next)
    {
        $this->checkForToken($request);
        try{
            if($this->auth->parseToken()->authenticate()){
                return $next($request);
            }

            throw new UnauthorizedHttpException("jwt-auth" , "not login");

        }catch (TokenExpiredException $exception){
            try{
                $token = $this->auth->refresh();
                Auth::guard('api')->onceUsingId(
                    $this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray()['sub']
                );
            }catch (JWTException $exception){
                throw new UnauthorizedHttpException('jwt-auth' , $exception->getMessage());
            }
        }
        // 在响应头中返回新的 token
        return $this->setAuthenticationHeader($next($request), $token);
    }
}
