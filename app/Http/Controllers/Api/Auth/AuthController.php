<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    const JSCODE2SESSION = '/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code';

    /**
     * register user
     *
     * @param Request $request
     * @param User    $user
     *
     * @return \Illuminate\Http\JsonResponse
     * @author  maxiongfei <maxiongfei@vchangyi.com>
     * @date    2018/11/28 4:01 PM
     */
    public function register(Request $request, User $user)
    {
        $postData = $request->only(['code', 'encryptedData', 'iv']);
        $params = array_merge(["appid" => env('APP_ID'), "app_secret" => env('APP_SECRET')], $postData);
        $url = vsprintf(self::JSCODE2SESSION, [$params['appid'], $params['app_secret'], $params['code']]);
        $response = $this->request("GET", $url);
        if (isset($response['data']->errcode)) {
            return $this->failed($response['data']->errmsg);

        }
        $params['sessionKey'] = $response['data']->session_key;
        $this->decryptData($params, $userInfo);
        // 查询数据库保存用户
        if (!$user->where(['open_id' => $userInfo->openId])->first()) {
            $user->create([
                'open_id'    => $userInfo->openId,
                'union_id'   => $userInfo->unionId,
                'nick_name'  => $userInfo->nickName,
                'gender'     => $userInfo->gender,
                'city'       => $userInfo->city,
                'province'   => $userInfo->province,
                'country'    => $userInfo->country,
                'avatar_url' => $userInfo->avatarUrl,
            ]);
        }
        $userData = $user->where(['open_id' => $userInfo->openId])->first();
        $token = auth('api')->login($userData);

        return $this->setHeaders(['Token' => $token])->success($userData, "登录成功");
    }

    public function login(Request $request, User $user)
    {
        /*$code = $request->post('code');
        $params = array_merge(["appid" => env('APP_ID'), "app_secret" => env('APP_SECRET')], ['code' => $code]);
        $url = vsprintf(self::JSCODE2SESSION, [$params['appid'], $params['app_secret'], $params['code']]);
        $response = $this->request("GET", $url);
        if (isset($response['data']->errcode)) {
            return $this->failed($response['data']->errmsg);
        }
        $sessionKey = $response['data']->session_key;
        $openId = $response['data']->openid;
        if (!$user->where(['open_id' => $openId])->first()) {
            throw new AuthenticationException('user not register');
        }*/
        $openId = 'oCvYQ0WsjF9XRWUUDAgeGUZ_xc5U';
        $userData = $user->where(['open_id' => $openId])->first();
        return $this->setHeaders(['Token' => auth('api')->login($userData)])->success($userData, "登录成功");
    }

    public function me()
    {
        return $this->success(Auth::guard('api')->user());
    }
}
