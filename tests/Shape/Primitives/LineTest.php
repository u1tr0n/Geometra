<?php

namespace Shape\Primitives;

use Geometra\Shape\Primitives\Line;
use Geometra\Shape\Primitives\Point;
use PHPUnit\Framework\TestCase;

class LineTest extends TestCase
{
    /**
     * Converts given Line, string and array into a single array.
     *
     * @param Point $start
     * @param Point $end
     * @param string $string The string to be included in the array.
     * @param array $array The array to be merged into the final array.
     * @return void
     * @dataProvider dataProvider
     * @covers       \Geometra\Shape\Primitives\Line::toArray
     */
    public function testToArray(Point $start, Point $end, string $string, array $array): void
    {
        $line = new Line(start: $start, end: $end);
        $result = $line->toArray();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('start', $result);
        $this->assertArrayHasKey('end', $result);
        $this->assertSame($array, $result);
    }

    /**
     * Converts the given Line object and string into a string representation.
     *
     * @param Point $start
     * @param Point $end
     * @param string $string The string to be included in the result.
     * @return void
     * @dataProvider dataProvider
     * @covers       \Geometra\Shape\Primitives\Line::__construct
     * @covers       \Geometra\Shape\Primitives\Line::__toString
     */
    public function test__toString(Point $start, Point $end, string $string): void
    {
        $line = (string)new Line(start: $start, end: $end);
        $this->assertSame($string, $line);
    }

    public static function dataProvider(): \Generator
    {
        yield 'simple test' => ['start' => new Point(5.27, 1/3), 'end' => new Point(1,1), 'string' => 'L[P[5.27, 0.33333333333333], P[1, 1]]', 'array' => ['start' => ['x' => 5.27, 'y' => 0.3333333333333333], 'end' => ['x' => 1.0, 'y' => 1.0]] ];
    }
}
