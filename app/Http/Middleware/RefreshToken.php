<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class RefreshToken extends BaseMiddleware
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
        $this->checkForToken($request);
        try {
            // 檢測用户的登錄狀態，如果正常則通過
            if ($this->auth->parseToken()->authenticate()) {
                return $next($request);
            }
            throw new UnauthorizedHttpException('jwt-auth', '未登录');
        } catch (TokenExpiredException $exception) {
            // 此處捕獲到了 token 過期所拋出的 TokenExpiredException 異常，我們在這裏需要做的是刷新該用户的 token 並將它添加到響應頭中
            try {
                // 刷新用户的 token
                $token = $this->auth->refresh();
                // 使用一次性登錄以保證此次請求的成功
                Auth:guard('api')->onceUsingId($this->auth->manager()->getPayloadFactory()->buildClaimsCollection()
                    ->toPlainArray()['sub']);
            } catch (JWTException $exception) {
                // 如果捕獲到此異常，即代表 refresh 也過期了，用户無法刷新令牌，需要重新登錄。
                throw new UnauthorizedHttpException('jwt-auth', $exception->getMessage());
            }
        }

        // 在响应头中返回新的 token
        return $this->setAuthenticationHeader($next($request), $token);
    }
}
