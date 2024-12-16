<?php

namespace BadMushroom\MojangApiClient\Shapes;

use Illuminate\Support\Arr;

class Profile implements ShapeInterface
{
    public function __construct(
        protected string $id,
        protected string $name,
        protected array $properties
    ) {
        // ...
    }

    // -- Getters

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSkin(): ?string
    {
        $texture = Arr::get($this->properties, '0.value');
        $decoded = (array) json_decode(base64_decode($texture), true);

        return Arr::get($decoded, 'textures.SKIN.url', null);
    }

    public function getCape(): ?string
    {
        $texture = Arr::get($this->properties, '1.value');
        $decoded = (array) json_decode(base64_decode($texture), true);

        return Arr::get($decoded, 'textures.CAPE.url', null);
    }

    // -- ShapeInterface Contract Methods

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'id'   => $this->getId(),
            'name' => $this->getName(),
            'skin' => $this->getSkin(),
            'cape' => $this->getCape(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}
