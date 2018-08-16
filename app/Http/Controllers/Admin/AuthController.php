<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     *  登陆
     */
    public function login()
    {
        $credentials = \request(['account', 'password']);
        if ($token = auth('api')->attempt($credentials)) {
            $this->error('账户或密码错误');
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
