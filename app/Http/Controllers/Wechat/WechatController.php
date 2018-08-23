<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Wechat\WechatMessage\EventController;
use App\Http\Controllers\Wechat\WechatMessage\MessageLogHandler;
use Illuminate\Support\Facades\Log;

class WechatController extends Controller
{
    use ApiResponse;
    protected $app;

    public function __construct()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志
        $this->app = app('wechat.miniProgram');
    }

    public function getWxUserInfo()
    {
        $code = request('code', '');
        $userInfo = $this->app->session($code);
        Log::info(json_encode($userInfo));
        return $this->success($userInfo);
    }

    public function server()
    {
        return $this->app->server->serve();
    }
}
