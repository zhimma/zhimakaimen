<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiRequest;
use App\Http\Traits\ApiResponse;

class BaseController extends Controller
{
    use ApiResponse;
    use ApiRequest;

    public function decryptData($params, &$data)
    {
        try {
            if (strlen($params['sessionKey']) != 24) {
                throw new \Exception("error sessionKey");
            }
            $aesKey = base64_decode($params['sessionKey']);
            if (strlen($params['iv']) != 24) {
                throw new \Exception('sessionKey iv');
            }
            $aesIV = base64_decode($params['iv']);
            $aesCipher = base64_decode($params['encryptedData']);
            $result = openssl_decrypt($aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);
            $dataObj = json_decode($result);
            if ($dataObj == null) {
                throw new \Exception("error data");
            }
            if ($dataObj->watermark->appid != $params['appid']) {
                throw new \Exception("error appid");
            }
            $data = $dataObj;
        } catch (\Exception $e) {
            return $this->failed($e->getMessage());
        }


    }
}
