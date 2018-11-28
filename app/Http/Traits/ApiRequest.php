<?php

namespace App\Http\Traits;


use GuzzleHttp\Client;

trait ApiRequest
{

    protected $client = null;
    protected $config = ['base_uri' => 'https://api.weixin.qq.com'];

    public function getClient()
    {
        if ($this->client != null) {
            return $this->client;
        }

        return new Client($this->config);
    }

    public function request($methed = "GET", $url, $params = [])
    {
        $response = $this->getClient()->request($methed, $url, $params);

        return [
            'code' => $response->getStatusCode(),
            'data' => json_decode($response->getBody()),
        ];
    }
}
