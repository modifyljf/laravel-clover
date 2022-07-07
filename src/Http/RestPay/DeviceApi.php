<?php

namespace Modifyljf\Clover\Http\RestPay;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Modifyljf\Clover\Http\ApiResource;

/**
 * Class DeviceApi
 * @package Modifyljf\Clover\Http\RestPay
 * @link https://docs.clover.com/reference/api-reference-overview
 */
class DeviceApi extends ApiResource
{
    /**
     * Retrieve a list of printers
     *
     * @return array|mixed
     * @throws RequestException
     * @link https://docs.clover.com/reference/retrieve_printers
     */
    public function listPrinters()
    {
        $mid = $this->client->getMerchantId();
        $token = $this->client->getToken();

        $deviceId = $this->client->getDeviceId();
        $posId = $this->client->getPosId();
        $version = $this->client->getVersion();
        $url = $this->client->getBaseUrl() . "/$version/device/printers";
        $headers = [
            'X-Clover-Device-Id' => $deviceId,
            'X-POS-ID' => $posId,
            'Content-Type' => 'application/json'
        ];

        return Http::withToken($token)->withHeaders($headers)->post($url, ['' => ''])->throw()->json();
    }
}
