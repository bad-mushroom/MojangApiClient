<?php

namespace BadMushroom\MojangApiClient;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MojangApiClient implements MojangApiClientInterface
{
    public function __construct(protected mixed $client)
    {
        // ...
    }

    /**
     * Send request to Mojang's API and return the response.
     *
     * @param string $id
     * @return mixed
     */
    public function get(string $url): mixed
    {
        $response = Http::get($url);

        if ($response->successful()) {
            return $response->json();
        } else {
            Log::error("Failed to fetch data from Mojang API ({$url}): {$response->status()}");
            throw new \Exception("Failed to fetch data from Mojang API.
                URL: {$url},
                Status Code: {$response->status()}
            ");
        }
    }

    /**
     * Convert a compact UUID to full UUID as prefered by the Client.
     */
    public function getFullUuid(string $uuid): string
    {
        return substr($uuid, 0, 8) . '-' .
            substr($uuid, 8, 4) . '-' .
            substr($uuid, 12, 4) . '-' .
            substr($uuid, 16, 4) . '-' .
            substr($uuid, 20);
    }

    /**
     * Convert a full UUID to compact UUID as prefered by the API.
     */
    public function getCompactUuid(string $uuid): string
    {
        return Str::replace('-', '', $uuid);
    }
}
