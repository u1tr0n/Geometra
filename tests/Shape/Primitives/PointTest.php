<?php

namespace Shape\Primitives;

use Geometra\Shape\Primitives\Point;
use PHPUnit\Framework\TestCase;

/**
 * Class PointTest
 *
 * This class contains unit tests for the \Geometra\Shape\Primitives\Point class.
 */
class PointTest extends TestCase
{

    /**
     * @param float $x1
     * @param float $y1
     * @param float $x2
     * @param float $y2
     * @return void
     * @dataProvider dataProviderEqual
     * @covers       \Geometra\Shape\Primitives\Point::equalTo
     */
    public function test_equalTo_self(float $x1, float $y1, float $x2, float $y2): void
    {
        $point1 = new Point(x: $x1, y: $y1);
        $point2 = new Point(x: $x2, y: $y2);
        $this->assertTrue($point1->equalTo($point2));
    }
    /**
     * @param float $x The x-coordinate of the point
     * @param float $y The y-coordinate of the point
     * @return void
     * @dataProvider dataProvider
     * @covers       \Geometra\Shape\Primitives\Point::equalTo
     */
    public function test_equalTo(float $x, float $y): void
    {
        $point = new Point(x: $x, y: $y);
        $this->assertTrue($point->equalTo($point));
    }

    /**
     * @param float $x
     * @param float $y
     * @param string $string
     * @return void
     * @dataProvider dataProvider
     * @covers \Geometra\Shape\Primitives\Point::__construct();
     * @covers \Geometra\Shape\Primitives\Point::__toArray();
     */
    public function test__toString(float $x, float $y, string $string): void
    {
        $point = new Point(x: $x, y: $y);

        $this->assertSame($string, (string)$point);
    }

    /**
     * @param float $x
     * @param float $y
     * @param string $string
     * @param array $array
     * @return void
     * @dataProvider dataProvider
     * @covers       \Geometra\Shape\Primitives\Point::toArray
     */
    public function testToArray(float $x, float $y, string $string, array $array): void
    {
        $point = new Point(x: $x, y: $y);

        $result = $point->toArray();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('x', $result);
        $this->assertArrayHasKey('y', $result);
        $this->assertSame($array, $result);
    }

    /**
     * Provides data for testing the 'toArray' and '_toString' method's of the Point class.
     *
     * @return \Generator
     * @dataProvider dataProvider
     */
    public static function dataProvider(): \Generator
    {
        yield 'Simple test' => ['x' => 0, 'y' => 0, 'string' => 'P[0, 0]', 'array' => ['x' => 0.0, 'y' => 0.0] ];
        yield 'Test with float coordinates' => ['x' => 5.27, 'y' => 1/3, 'string' => 'P[5.27, 0.33333333333333]', 'array' => ['x' => 5.27, 'y' => .3333333333333333] ];
    }

    /**
     * Provides test data for the equality test.
     *
     * @return \Generator
     * @dataProvider dataProviderEqual
     */
    public static function dataProviderEqual(): \Generator
    {
        yield 'Simple test' => ['x1' => 0, 'y1' => 0, 'x2' => 0, 'y2' => 0];
        yield 'Test with float coordinates' => ['x1' => 5.27, 'y1' => 1/3, 'x2' => 5.27, 'y2' => 0.3333333333333333];
    }
}
