<?php

namespace Modifyljf\Clover\Http;

/**
 * Class ApiResource
 * @package Modifyljf\Clover\Http\Platform
 */
abstract class ApiResource
{
    /**
     * @var Client
     */
    protected Client $client;

    /**
     * @param Client $client used to communicate with clover.
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
