<?php

namespace BadMushroom\MojangApiClient\Shapes;

interface ShapeInterface
{
    /**
     * Convert the shape to an array.
     */
    public function toArray(): array;

    /**
     * Convert the shape to a JSON string.
     */
    public function toJson(): string;
}
