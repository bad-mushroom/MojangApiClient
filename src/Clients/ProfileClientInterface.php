<?php

namespace BadMushroom\MojangApiClient\Clients;

use BadMushroom\MojangApiClient\Shapes\ShapeInterface;

interface ProfileClientInterface
{
    /**
     * Get the player's profile data from their Mojang ID
     */
    public function id(string $uuid): ShapeInterface;

    /**
     * Get the player's profile data from their Mojang name
     */
    public function name(string $name): ShapeInterface;
}
