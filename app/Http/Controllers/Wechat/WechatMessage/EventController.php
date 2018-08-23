<?php

namespace App\Http\Controllers\Wechat\WechatMessage;


use App\Http\Controllers\Controller;

class EventController extends  Controller
{
    public function handle($message)
    {
        return "message";
    }
}
