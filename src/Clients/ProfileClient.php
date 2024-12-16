<?php

namespace BadMushroom\MojangApiClient\Clients;

use BadMushroom\MojangApiClient\MojangApiClient;
use BadMushroom\MojangApiClient\Shapes;
use Illuminate\Support\Arr;

class ProfileClient extends MojangApiClient implements ProfileClientInterface
{
    public function __construct(
        protected string $apiUrl,
        protected string $sessionUrl)
    {
        // ...
    }

    /**
     * @inheritDoc
     */
    public function id(string $uuid): Shapes\ShapeInterface
    {
        $uuid = $this->getCompactUuid($uuid);
        $response = $this->get($this->sessionUrl . '/session/minecraft/profile/' . $uuid);

        return new Shapes\Profile(
            $this->getFullUuid(Arr::get($response, 'id')),
            $response['name'],
            $response['properties']
        );
    }

    /**
     * @inheritDoc
     */
    public function name(string $name): Shapes\ShapeInterface
    {
        $response = $this->get($this->apiUrl . '/users/profiles/minecraft/' . $name);

        return $this->id(Arr::get($response, 'id'));
    }
}
