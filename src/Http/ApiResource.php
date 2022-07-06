<?php

namespace Modifyljf\Clover\Http;

use Modifyljf\Clover\Client;

/**
 * Class ApiResource
 * @package Modifyljf\Clover\Http
 */
abstract class ApiResource
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client used to communicate with clover.
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
