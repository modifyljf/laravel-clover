<?php

namespace Modifyljf\Clover;

use Modifyljf\Clover\Exceptions\CloverException;
use Modifyljf\Clover\Http\ApiResource;
use Modifyljf\Clover\Http\EmployeeApi;
use Modifyljf\Clover\Http\InventoryApi;
use Modifyljf\Clover\Http\MerchantApi;
use Modifyljf\Clover\Http\OrderApi;

/**
 * Class Client
 *
 * @property MerchantApi $merchants
 * @property EmployeeApi $employees
 * @property InventoryApi $inventory
 * @property OrderApi $orders
 * @package Modifyljf\Clover
 */
class Client
{
    /**
     * Demo environment.
     */
    const ENV_DEMO = 'demo';

    /**
     * Live environment.
     */
    const ENV_PROD = 'production';

    /**
     * Sandbox api url.
     */
    const SANDBOX_URL = 'https://sandbox.dev.clover.com';

    /**
     * Production api url.
     */
    const PRODUCTION_URL = 'https://api.clover.com';

    /**
     * @var string
     */
    protected string $version = 'v3';

    /**
     * @var string
     */
    protected string $environment = 'demo';

    /**
     * @var string
     */
    protected string $baseUrl = '';

    /**
     * @var string
     */
    protected string $merchantId = '';

    /**
     * @var string
     */
    protected string $token = '';

    /**
     * @param ...$params
     */
    public function __construct(...$params)
    {
        foreach ($params as $name => $value) {
            $this->$name = $value;
        }
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     * @return Client
     */
    public function setVersion(string $version): Client
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }

    /**
     * @param string $environment
     * @return Client
     */
    public function setEnvironment(string $environment): Client
    {
        $this->environment = $environment;
        return $this;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        if (!empty($this->baseUrl)) {
            return $this->baseUrl;
        } else {
            return self::ENV_DEMO == $this->environment ? self::SANDBOX_URL : self::PRODUCTION_URL;
        }
    }

    /**
     * @param string $baseUrl
     * @return Client
     */
    public function setBaseUrl(string $baseUrl): Client
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     * @return Client
     */
    public function setClientId(string $clientId): Client
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     * @return Client
     */
    public function setClientSecret(string $clientSecret): Client
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    /**
     * @param string $merchantId
     * @return Client
     */
    public function setMerchantId(string $merchantId): Client
    {
        $this->merchantId = $merchantId;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return Client
     */
    public function setToken(string $token): Client
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return MerchantApi
     */
    public function getMerchants(): MerchantApi
    {
        return new MerchantApi($this);
    }

    /**
     * @return EmployeeAPI
     */
    public function getEmployees(): EmployeeAPI
    {
        return new EmployeeApi($this);
    }

    /**
     * @return InventoryApi
     */
    public function getInventory(): InventoryApi
    {
        return new InventoryApi($this);
    }

    /**
     * @return OrderApi
     */
    public function getOrders(): OrderApi
    {
        return new OrderApi($this);
    }

    /**
     * Magic getter to lazy load api resource
     *
     * @param string $name Domain to return
     * @return ApiResource The requested api resource
     * @throws CloverException For unknown domains
     */
    public function __get(string $name)
    {
        $method = 'get' . \ucfirst($name);
        if (\method_exists($this, $method)) {
            return $this->$method();
        }

        throw new CloverException('Unknown api resource ' . $name);
    }
}
