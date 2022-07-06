<?php

namespace Modifyljf\Clover\Http;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * OAuth
 * @package Modifyljf\Clover
 */
class OAuth extends Client
{
    /**
     * Sandbox api url.
     */
    const SANDBOX_URL = "https://sandbox.dev.clover.com";

    /**
     * Production api url.
     */
    const PRODUCTION_URL = "https://www.clover.com";

    /**
     * @var string
     */
    protected string $clientId = '';

    /**
     * @var string
     */
    protected string $clientSecret = '';

    /**
     * @param string $clientId
     * @param string $clientSecret
     */
    public function __construct(string $clientId, string $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * @param $authCode
     * @return string
     */
    public function accessToken($authCode)
    {
        Log::debug(get_class($this) . "::accessToken => Get the access token by client id, client secret, and auth code.");

        $clientId = $this->clientId ?? config("clover.client_id");
        $clientSecret = $this->clientSecret ?? config("clover.client_secret");

        $baseUrl = $this->baseUrl;
        if (empty($baseUrl)) {
            if ("production" != config("clover.env")) {
                $baseUrl = self::SANDBOX_URL;
            } else {
                $baseUrl = self::PRODUCTION_URL;
            }
        }

        $response = Http::post("$baseUrl/oauth/token", [
            "client_id" => $clientId,
            "client_secret" => $clientSecret,
            "code" => $authCode,
        ])->json();

        return $response["access_token"];
    }
}
