<?php

namespace Geometra\Shape\Interface;

interface PrimitiveGroupInterface
{
    public function add(PrimitiveShapeInterface $item): self;
    public function has(PrimitiveShapeInterface $item): bool;
    public function remove(PrimitiveShapeInterface $item): self;
    public function count(): int;
}
