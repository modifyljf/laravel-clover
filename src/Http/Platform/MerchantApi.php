<?php

namespace Modifyljf\Clover\Http\Platform;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Modifyljf\Clover\Http\ApiResource;

/**
 * Class MerchantApi
 * @package Modifyljf\Clover\Http\Platform
 * @link https://docs.clover.com/reference/api-reference-overview
 */
class MerchantApi extends ApiResource
{
    /**
     * Get a single merchant
     *
     * @param array|null $expandFields
     * @return array
     * @throws RequestException
     * @link https://docs.clover.com/reference/merchantgetmerchant
     */
    public function retrieveMerchant(?array $expandFields = [])
    {
        $mid = $this->client->getMerchantId();
        $token = $this->client->getToken();
        $version = $this->client->getVersion();
        $url = $this->client->getBaseUrl() . "/$version/merchants/$mid";

        $expandArr = array_merge(['owner', 'tipSuggestions'], $expandFields);
        $expand = implode(',', $expandArr);

        return Http::withToken($token)->get($url, [
            'expand' => $expand,
        ])->throw()->json();
    }

    /**
     * Get a merchant's address
     * @return array
     * @throws RequestException
     * @link https://docs.clover.com/reference/merchantgetmerchantaddress
     */
    public function retrieveAddress()
    {
        $mid = $this->client->getMerchantId();
        $token = $this->client->getToken();
        $version = $this->client->getVersion();
        $url = $this->client->getBaseUrl() . "/$version/merchants/$mid/address";

        return Http::withToken($token)->get($url)->throw()->json();
    }

    /**
     * Get all tax rates
     *
     * @return array
     * @throws RequestException
     * @link https://docs.clover.com/reference/taxrategettaxrates
     */
    public function listTaxRates()
    {
        $mid = $this->client->getMerchantId();
        $token = $this->client->getToken();
        $version = $this->client->getVersion();
        $url = $this->client->getBaseUrl() . "/$version/merchants/$mid/tax_rates";

        return Http::withToken($token)->get($url)->throw()->json(['elements']);
    }

    /**
     * Get merchant opening hours
     *
     * @return array
     * @throws RequestException
     * @link https://docs.clover.com/reference/merchantgetallmerchantopeninghours
     */
    public function retrieveOpenHours()
    {
        $mid = $this->client->getMerchantId();
        $token = $this->client->getToken();
        $version = $this->client->getVersion();
        $url = $this->client->getBaseUrl() . "/$version/merchants/$mid/opening_hours";

        return Http::withToken($token)->get($url)->throw()->json(['elements']);
    }

    /**
     * Get all tip suggestions for a merchant
     *
     * @return array
     * @throws RequestException
     * @link https://docs.clover.com/reference/merchantgettipsuggestions
     */
    public function listTipSuggestions()
    {
        $mid = $this->client->getMerchantId();
        $token = $this->client->getToken();
        $version = $this->client->getVersion();
        $url = $this->client->getBaseUrl() . "/$version/merchants/$mid/tip_suggestions";

        return Http::withToken($token)->get($url)->throw()->json(['elements']);
    }

    /**
     * Get all devices provisioned to a merchant
     *
     * @return array|mixed
     * @throws RequestException
     * @link https://docs.clover.com/reference/devicegetmerchantdevices
     */
    public function listDevices()
    {
        $mid = $this->client->getMerchantId();
        $token = $this->client->getToken();
        $version = $this->client->getVersion();
        $url = $this->client->getBaseUrl() . "/$version/merchants/$mid/devices";

        return Http::withToken($token)->get($url)->throw()->json(['elements']);
    }

    /**
     * Get a single device provisioned to a merchant
     *
     * @param string $deviceId
     * @return array|mixed
     * @throws RequestException
     * @link https://docs.clover.com/reference/devicegetmerchantdevice
     */
    public function retrieveDevice(string $deviceId)
    {
        $mid = $this->client->getMerchantId();
        $token = $this->client->getToken();
        $version = $this->client->getVersion();
        $url = $this->client->getBaseUrl() . "/$version/merchants/$mid/devices/$deviceId";

        return Http::withToken($token)->get($url)->throw()->json(['elements']);
    }

    /**
     * Get all order types for a merchant
     *
     * @return array|mixed
     * @throws RequestException
     * @link https://docs.clover.com/reference/merchantcreateordertype
     */
    public function listOrderTypes()
    {
        $mid = $this->client->getMerchantId();
        $token = $this->client->getToken();
        $version = $this->client->getVersion();
        $url = $this->client->getBaseUrl() . "/$version/merchants/$mid/order_types";

        return Http::withToken($token)->get($url)->throw()->json(['elements']);
    }

    /**
     * Create Order Type For Merchant
     *
     * @return array|mixed
     * @throws RequestException
     * @link https://docs.clover.com/reference/merchantcreateordertype
     */
    public function createOrderType($data)
    {
        $mid = $this->client->getMerchantId();
        $token = $this->client->getToken();
        $version = $this->client->getVersion();
        $url = $this->client->getBaseUrl() . "/$version/merchants/$mid/order_types";

        return Http::withToken($token)->post($url, $data)->throw()->json();
    }

    /**
     * Return a list of system order types
     *
     * @return array|mixed
     * @throws RequestException
     * @link https://docs.clover.com/reference/merchantgetsystemordertypes
     */
    public function listSystemOrderTypes()
    {
        $mid = $this->client->getMerchantId();
        $token = $this->client->getToken();
        $version = $this->client->getVersion();
        $url = $this->client->getBaseUrl() . "/$version/merchants/$mid/system_order_types";

        return Http::withToken($token)->get($url)->throw()->json(['elements']);
    }
}
