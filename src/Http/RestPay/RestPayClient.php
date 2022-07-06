<?php

namespace Modifyljf\Clover\Http;

use Modifyljf\Clover\Http\RestPay\DeviceApi;

/**
 * Class Client
 *
 * @property DeviceApi $merchants
 * @package Modifyljf\Clover
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
    public function getDeviceId(): string
    {
        return $this->deviceId;
    }

    /**
     * @param string $deviceId
     * @return Client
     */
    public function setDeviceId(string $deviceId): Client
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
    public function setPosId(string $posId): Client
    {
        $this->posId = $posId;
        return $this;
    }
}
