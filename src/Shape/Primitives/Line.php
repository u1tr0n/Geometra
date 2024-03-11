<?php

namespace Geometra\Shape\Primitives;

use Geometra\Shape\Interface\ShapeInterface;

/**
 * Represents a line shape with a start and end point.
 *
 * This class extends the PrimitiveShape class.
 */
class Line extends PrimitiveShape
{
    /**
     * Class constructor.
     *
     * @param Point $start The starting point.
     * @param Point $end The ending point.
     *
     * @return void
     */
    public function __construct(
        public readonly Point $start,
        public readonly Point $end,
    ) {}

    /**
     * Returns a string representation of the object.
     *
     * The string representation is in the form "L[start, end]", where start and end
     * are the values of the object's properties $start and $end, respectively.
     *
     * @return string The string representation of the object.
     */
    public function __toString() : string
    {
        return "L[{$this->start}, {$this->end}]";
    }

    /**
     * Returns an array representation of the object.
     *
     * The array representation consists of the properties of the object,
     * where each property is represented as a key-value pair in the array.
     *
     * @return array The array representation of the object.
     */
    public function toArray(): array
    {
        return [
            'start' => $this->start->toArray(),
            'end' => $this->end->toArray(),
        ];
    }

    /**
     * Determines if the current object is equal to the specified ShapeInterface object.
     *
     * This method checks if the current object is an instance of the same class as $to
     * and if the start and end properties of both objects are equal.
     *
     * @param ShapeInterface $to The object to compare to.
     *
     * @return bool True if the objects are equal, false otherwise.
     */
    public function equalTo(ShapeInterface $to): bool
    {
        if ($to instanceof self) {
            return $this->start->equalTo($to->start) && $this->end->equalTo($to->end);
        }

        return false;
    }
}
