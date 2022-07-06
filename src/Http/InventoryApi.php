<?php

namespace Modifyljf\Clover\Http;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

/**
 * Class InventoryApi
 * @package Modifyljf\Clover\Http
 * @link https://docs.clover.com/reference/api-reference-overview
 */
class InventoryApi extends ApiResource
{
    /**
     * Get all categories
     *
     * @return array
     * @throws RequestException
     * @link https://docs.clover.com/reference/categorygetcategories
     */
    public function listMenuCategories()
    {
        $mid = $this->client->getMerchantId();
        $token = $this->client->getToken();
        $version = $this->client->getVersion();
        $url = $this->client->getBaseUrl() . "/$version/merchants/$mid/categories";

        return Http::withToken($token)->get($url, [
            'expand' => 'items',
        ])->throw()->json(['elements']);
    }

    /**
     * Get all modifier groups
     *
     * @return array
     * @throws RequestException
     * @link https://docs.clover.com/reference/modifiergetmodifiergroups
     */
    public function listModifierGroups()
    {
        $mid = $this->client->getMerchantId();
        $token = $this->client->getToken();
        $version = $this->client->getVersion();
        $url = $this->client->getBaseUrl() . "/$version/merchants/$mid/modifier_groups";

        $expandArr = ['modifiers', 'items'];
        $expand = implode(',', $expandArr);

        return Http::withToken($token)->get($url, [
            'expand' => $expand,
        ])->throw()->json(['elements']);
    }
}
