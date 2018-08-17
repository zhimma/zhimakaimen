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
        if ($token = auth('api')->attempt($credentials)) {
            $this->failed('账户或密码错误');
        }

        $this->setStatusCode(404)->setHeaders(['Authorization' => 'Bearer ' . $token])->success();
        return $this->success('登陆成功');
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
