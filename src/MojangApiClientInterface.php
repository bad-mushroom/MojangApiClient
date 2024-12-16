<?php

namespace BadMushroom\MojangApiClient;

interface MojangApiClientInterface
{
    /**
     * Get the player's profile data from their Mojang ID
     */
    public function get(string $url): mixed;

    /**
     * Get the full UUID from the short UUID
     */
    public function getFullUuid(string $uuid): string;

    /**
     * Get the compact UUID from the full UUID
     */
    public function getCompactUuid(string $uuid): string;
}
