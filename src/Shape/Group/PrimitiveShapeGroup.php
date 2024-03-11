<?php

namespace Geometra\Shape\Group;

use Geometra\Shape\Group;
use Geometra\Shape\Interface\PrimitiveGroupInterface;
use Geometra\Shape\Interface\PrimitiveShapeInterface;
use Iterator;

/**
 * Class PrimitiveShapeGroup
 *
 * Represents a group of primitive shapes.
 *
 * @package MyPackage
 */
class PrimitiveShapeGroup extends Group implements PrimitiveGroupInterface, Iterator
{
    /** @var PrimitiveShapeInterface[]  */
    private array $group;
    private int $current = 0;

    /**
     * Constructs a new instance of the class.
     *
     * @param array<array-key, PrimitiveShapeInterface> $items The elements to initialize the group with (optional).
     * @return void
     */
    public function __construct(array $items = [])
    {
        $this->group = $items;
    }

    /**
     * Adds a primitive shape item to the group, if it is not already present.
     *
     * @param PrimitiveShapeInterface $item The primitive shape item to be added to the group.
     *
     * @return PrimitiveGroupInterface Returns the current instance of the primitive group after adding the item.
     */
    public function add(PrimitiveShapeInterface $item): PrimitiveGroupInterface
    {
        if (!$this->has($item)) {
            $this->group[] = $item;
        }

        return $this;
    }


    /**
     * Checks if a primitive shape item exists in the group.
     *
     * @param PrimitiveShapeInterface $item The primitive shape item to be checked.
     *
     * @return bool Returns true if the item exists in the group, false otherwise.
     */
    public function has(PrimitiveShapeInterface $item): bool
    {
        return in_array($item, $this->group);
    }

    /**
     * Removes the specified item from the group.
     *
     * @param PrimitiveShapeInterface $item The item to be removed from the group.
     * @return PrimitiveGroupInterface The updated group after removing the item.
     */
    public function remove(PrimitiveShapeInterface $item): PrimitiveGroupInterface
    {
        if ($this->has($item)) {
            foreach ($this->group as $key => $groupItem) {
                if ($item->equalTo($groupItem)) {
                    unset($this->group[$key]);
                }
            }
        }

        return $this;
    }

    /**
     * Returns the current item in the group.
     *
     * @return PrimitiveShapeInterface The current item in the group.
     */
    public function current(): ?PrimitiveShapeInterface
    {
        return $this->group[$this->current] ?? null;
    }

    /**
     * Returns the current key.
     *
     * @return int The current key.
     */
    public function key(): int
    {
        return $this->current;
    }

    /**
     * Checks if the current item is valid in the group.
     *
     * @return bool Returns true if the current item is valid, false otherwise.
     */
    public function valid(): bool
    {
        return $this->current >= 0
            && $this->current < $this->count()
            && array_key_exists($this->current, $this->group)
        ;
    }


    /**
     * Sets the internal pointer of the group to the first element.
     *
     * @return void
     */
    public function rewind(): void
    {
        $this->current = array_key_first($this->group);
    }

    /**
     * Advances the current pointer to the next element.
     *
     * @return void
     */
    public function next(): void
    {
        ++$this->current;
    }

    /**
     * Returns the number of elements in the group.
     *
     * @return int The number of elements in the group.
     */
    public function count(): int
    {
        return count($this->group);
    }
}
