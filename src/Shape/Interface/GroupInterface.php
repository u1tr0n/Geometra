<?php

namespace Geometra\Shape\Interface;

interface GroupInterface
{
    public function add(ShapeInterface $item): self;
    public function has(ShapeInterface $item): bool;
    public function remove(ShapeInterface $item): self;
}
