<?php

namespace Modifyljf\Clover\Http\RestPay;

use Modifyljf\Clover\Http\Client;
use Modifyljf\Clover\Http\Platform\InventoryApi;

/**
 * Class RestPayClient
 *
 * @property DeviceApi $devices
 * @package Modifyljf\Clover\Http\RestPay
 */
class RestPayClient extends Client
{
    /**
     * @var string
     */
    protected string $version = 'v1';

    /**
     * @var string
     */
    protected string $deviceId;

    /**
     * @var string
     */
    protected string $posId;

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        if (!empty($this->baseUrl)) {
            return $this->baseUrl;
        } else {
            return (self::ENV_DEMO == $this->environment ? self::SANDBOX_URL : self::PRODUCTION_URL) . '/connect';
        }
    }

    /**
     * @return string
     */
    public function getDeviceId(): string
    {
        return $this->deviceId;
    }

    /**
     * @param string $deviceId
     * @return Client
     */
    public function setDeviceId(string $deviceId): RestPayClient
    {
        $this->deviceId = $deviceId;
        return $this;
    }

    /**
     * @return string
     */
    public function getPosId(): string
    {
        return $this->posId;
    }

    /**
     * @param string $posId
     * @return Client
     */
    public function setPosId(string $posId): RestPayClient
    {
        $this->posId = $posId;
        return $this;
    }

    /**
     * @return DeviceApi
     */
    public function getDevices(): DeviceApi
    {
        return new DeviceApi($this);
    }
}
