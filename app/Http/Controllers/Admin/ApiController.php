<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{

    protected $statusCode = 200;
    protected $headers = [];

    public function success($data = [], $status = 'success')
    {
        return $this->send($status, compact('data'));

    }

    public function send($status, array $data, $code = null)
    {
        if (!$code) {
            $this->setStatusCode();
        }
        $return = [
            'status' => $status,
            'code' => $this->getStatusCode()
        ];
        $sendData = array_merge($return, $data);
        return $this->respond($sendData);

    }

    public function respond($data)
    {
        return \Response::json($data, $this->getStatusCode(), $this->getHeaders());
    }

    public function setStatusCode($code = 200)
    {
        $this->statusCode = $code;
        return $this;
    }

    public function setHeaders($headers = [])
    {
        $this->headers = $headers;
        return $this;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getHeaders()
    {
        return $this->headers;
    }


    public function error($message = '失败')
    {
        response()->json([
            'code' => 'failed',
            'message' => $message
        ]);
    }
}
