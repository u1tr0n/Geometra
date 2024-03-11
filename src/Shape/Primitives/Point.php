<?php

namespace Geometra\Shape\Primitives;


use Geometra\Shape\Interface\ShapeInterface;

/**
 * Class Point
 *
 * Represents a point in a Cartesian coordinate system.
 */
class Point extends PrimitiveShape
{
    /**
     * Constructs a new instance of the class.
     *
     * @param float $x The value of x coordinate.
     * @param float $y The value of y coordinate.
     */
    public function __construct(
        public readonly float $x,
        public readonly float $y,
    ) {}

    /**
     * Returns a string representation of the object.
     *
     * The string consists of the literal "P" followed by the x-coordinate and y-coordinate of the object, enclosed in square brackets.
     *
     * @return string Returns a string representation of the object.
     */
    public function __toString(): string
    {
        return "P[$this->x, $this->y]";
    }

    /**
     * Returns an array representation of the object.
     *
     * The array consists of key-value pairs for the x-coordinate and y-coordinate of the object.
     *
     * @return array An array representation of the object.
     */
    public function toArray(): array
    {
        return [
            'x' => $this->x,
            'y' => $this->y,
        ];
    }

    /**
     * Checks if the current shape object is equal to the given shape object.
     *
     * This method compares the x-coordinate and y-coordinate of the current shape object with the x-coordinate and y-coordinate of the given shape object.
     * If the given shape object is an instance of the same shape class and has the same x-coordinate and y-coordinate values, this method will return true.
     * Otherwise, it will return false.
     *
     * @param ShapeInterface $to The shape object to compare with.
     * @return bool Returns true if the current shape object is equal to the given shape object, otherwise returns false.
     */
    public function equalTo(ShapeInterface $to): bool
    {
        if ($to instanceof self) {
            return $this->x === $to->x && $this->y === $to->y;
        }

        return false;
    }
}
