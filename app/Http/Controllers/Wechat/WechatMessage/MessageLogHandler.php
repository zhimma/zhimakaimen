<?php
/**
 * Created by PhpStorm.
 * User: mma
 * Date: 2018/8/22
 * Time: 下午4:21
 */

namespace App\Http\Controllers\Wechat\WechatMessage;


use Illuminate\Support\Facades\Log;

class MessageLogHandler implements \EasyWeChat\Kernel\Contracts\EventHandlerInterface
{
    public function handle($message = '')
    {
        Log::debug(json_encode($message));

    }}