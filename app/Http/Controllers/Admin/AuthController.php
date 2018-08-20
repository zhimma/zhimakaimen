<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminsRequest;

class AuthController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @param AdminsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AdminsRequest $request)
    {
        $credentials = $request->only(['account', 'password']);
        if (!$token = auth('api')->attempt($credentials)) {
            return $this->failed('账户或密码错误');
        }

        return $this->setStatusCode(200)->setHeaders(['Authorization' => 'Bearer ' . $token])->success($token);
    }

    public function logout()
    {
        auth('api')->logout();
        return $this->success('退出成功');
    }

    public function refresh()
    {

    }

    public function me()
    {

    }
}
