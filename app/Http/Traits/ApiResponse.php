<?php

namespace App\Http\Traits;

use Symfony\Component\HttpFoundation\Response;

trait ApiResponse
{

    protected $statusCode = 200;
    protected $code       = 200;
    protected $headers    = [];

    public function success($data = [], $status = 'success')
    {
        return $this->send($status, $this->code, compact('data'));
    }

    public function send($status, $code, array $data)
    {
        /*if (!$code) {
            $this->setStatusCode();
        }*/
        $return = [
            'status' => $status,
//            'httpCode' => $this->getStatusCode(),
            'code'   => $code,
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


    public function failed($message, $code = Response::HTTP_BAD_REQUEST, $status = 'error')
    {
        return $this->send($status, $code, compact('message'));
    }

    public function notFound($message = 'Not Found')
    {
        return $this->failed($message, Response::HTTP_NOT_FOUND);
    }
}
