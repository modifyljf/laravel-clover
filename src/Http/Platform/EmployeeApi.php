<?php

namespace Modifyljf\Clover\Http\Platform;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Modifyljf\Clover\Http\ApiResource;

/**
 * Class EmployeeApi
 * @package Modifyljf\Clover\Http\Platform
 * @link https://docs.clover.com/reference/api-reference-overview
 */
class EmployeeApi extends ApiResource
{
    /**
     * Get all employees
     *
     * @return array|mixed
     * @throws RequestException
     * @link https://docs.clover.com/reference/employeegetemployees
     */
    public function listEmployees()
    {
        $mid = $this->client->getMerchantId();
        $token = $this->client->getToken();
        $version = $this->client->getVersion();
        $url = $this->client->getBaseUrl() . "/$version/merchants/$mid/employees";

        return Http::withToken($token)->get($url)->throw()->json(['elements']);
    }
}
