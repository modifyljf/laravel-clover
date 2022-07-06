<?php

namespace Modifyljf\Clover\Http\Platform;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Modifyljf\Clover\Http\ApiResource;

/**
 * Class OrderApi
 * @package Modifyljf\Clover\Http\Platform
 * @link https://docs.clover.com/reference/api-reference-overview
 */
class OrderApi extends ApiResource
{
    /**
     * Create custom orders.
     *
     * @return array|mixed
     * @throws RequestException
     * @link https://docs.clover.com/reference/ordercreateorder
     */
    public function createOrder(array $data = [])
    {
        $mid = $this->client->getMerchantId();
        $token = $this->client->getToken();
        $version = $this->client->getVersion();
        $url = $this->client->getBaseUrl() . "/$version/merchants/$mid/orders";

        return Http::withToken($token)->post($url, $data)->throw()->json();
    }

    /**
     * Create a line items
     *
     * @param string $orderId
     * @param array $lineItem
     * @return array|mixed
     * @throws RequestException
     * @link https://docs.clover.com/reference/ordercreatelineitem
     */
    public function createLineItem(string $orderId, array $lineItem = [])
    {
        $mid = $this->client->getMerchantId();
        $token = $this->client->getToken();
        $version = $this->client->getVersion();
        $url = $this->client->getBaseUrl() . "/$version/merchants/$mid/orders/$orderId/line_items";

        return Http::withToken($token)->post($url, $lineItem)->throw()->json();
    }

    /**
     * Create multiple line items
     *
     * @param string $orderId
     * @param array $lineItems
     * @return array|mixed
     * @throws RequestException
     * @link https://docs.clover.com/reference/orderbulkcreatelineitems
     */
    public function createLineItems(string $orderId, array $lineItems = [])
    {
        $mid = $this->client->getMerchantId();
        $token = $this->client->getToken();
        $version = $this->client->getVersion();
        $url = $this->client->getBaseUrl() . "/$version/merchants/$mid/orders/$orderId/bulk_line_items";

        return Http::withToken($token)->post($url, [
            'items' => $lineItems
        ])->throw()->json();
    }
}
