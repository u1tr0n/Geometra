<?php

namespace Geometra\Shape\Interface;

interface ShapeInterface
{
    public function __toString(): string;
    public function toArray(): array;
    public function equalTo(ShapeInterface $to): bool;
}
