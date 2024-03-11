<?php

namespace Geometra\Shape\Group;

use Geometra\Shape\Primitives\Point;
use PHPUnit\Framework\TestCase;

class PrimitiveShapeGroupTest extends TestCase
{

    /**
     * @test
     *
     * Method: test__construct_empty_array
     *
     * Description: This test case verifies that after initializing a new instance of PrimitiveShapeGroup,
     *              the count of shapes in the group is equal to zero.
     *
     * @return void
     * @covers \Geometra\Shape\Group\PrimitiveShapeGroup::__construct
     */
    public function test__construct_empty_array(): void
    {
        $group = new PrimitiveShapeGroup();
        $this->assertSame(0, $group->count());
    }

    /**
     * @test
     *
     * Method: test__construct
     *
     * Description: This test case verifies that after initializing a new instance of PrimitiveShapeGroup,
     *              the count of shapes in the group is equal to the provided number of items in the constructor parameter.
     *
     * @return void
     * @covers \Geometra\Shape\Group\PrimitiveShapeGroup::__construct
     */
    public function test__construct(): void
    {

        $items = [];

        $groupSize = mt_rand(1, 10);
        for ($i=0; $i< $groupSize; ++$i) {
            $items[] = new Point(x: mt_rand(0, 100), y: mt_rand(0, 100));
        }

        $group = new PrimitiveShapeGroup($items);

        $this->assertSame($groupSize, $group->count());

    }

    /**
     * Removes an item from a PrimitiveShapeGroup and asserts the correct change in count.
     *
     * The testRemove method creates a PrimitiveShapeGroup, adds random Point objects to it,
     * and then randomly selects one item to remove. The method asserts that the count of
     * the group before and after the removal is the same, indicating that the removal was successful.
     *
     * @return void
     * @covers \Geometra\Shape\Group\PrimitiveShapeGroup::remove
     */
    public function testRemove(): void
    {
        $items = [];

        $group = new PrimitiveShapeGroup();

        $groupSize = mt_rand(1, 10);
        for ($i=0; $i< $groupSize; ++$i) {
            $point = new Point(x: mt_rand(0, 100), y: mt_rand(0, 100));
            $items[] = $point;
            $group->add($point);
        }

        $this->assertSame($groupSize, $group->count());

        $removeItemIndex = mt_rand(0, $groupSize - 1);

        $group->remove($items[$removeItemIndex]);

        $this->assertSame($groupSize - 1, $group->count());




    }

    /**
     * Test the functionality of adding elements to a PrimitiveShapeGroup object with an empty constructor.
     *
     * @return void
     * @covers \Geometra\Shape\Group\PrimitiveShapeGroup::add
     */
    public function testAddEmptyConstruct(): void
    {
        $groupSize = mt_rand(1, 10);
        $group = new PrimitiveShapeGroup();
        $this->assertSame(0, $group->count());
        for ($i=0; $i< $groupSize; $i++) {
            $group->add(new Point(x: mt_rand(0, 100), y: mt_rand(0, 100)));
            $this->assertSame($i + 1, $group->count());
        }
    }

    /**
     * Test the functionality of adding elements to a PrimitiveShapeGroup object with a filled constructor.
     *
     * @return void
     * @covers \Geometra\Shape\Group\PrimitiveShapeGroup::add
     */
    public function testAddFilledConstruct(): void
    {
        $items = [];

        $groupSize = mt_rand(1, 10);
        for ($i=0; $i< $groupSize; ++$i) {
            $point = new Point(x: mt_rand(0, 100), y: mt_rand(0, 100));
            $items[] = $point;
        }

        $group = new PrimitiveShapeGroup($items);

        $this->assertSame($groupSize, $group->count());

        $addGroupSize = mt_rand(1, 10);

        for ($i=0; $i< $addGroupSize; $i++) {
            $group->add(new Point(x: mt_rand(0, 100), y: mt_rand(0, 100)));
        }

        $this->assertSame($groupSize + $addGroupSize, $group->count());
    }

    /**
     * Test the add() method of the PrimitiveShapeGroup class with the same item added multiple times.
     *
     * This test ensures that when the add() method is called multiple times with the same item, the count of the shape group remains 1.
     *
     * @return void
     * @covers \Geometra\Shape\Group\PrimitiveShapeGroup::add
     */
    public function testAddWithAddSameItem(): void
    {
        $groupSize = mt_rand(1, 10);
        $sameShape = new Point(mt_rand(0, 100), mt_rand(0, 100));
        $group = new PrimitiveShapeGroup();

        for ($i=0; $i< $groupSize; ++$i) {
            $group->add($sameShape);
        }

        $this->assertSame(1, $group->count());

    }

    /**
     * Checks if the given shape exists in the PrimitiveShapeGroup.
     *
     * @return void
     * @covers \Geometra\Shape\Group\PrimitiveShapeGroup::has
     */
    public function testHasPositive(): void
    {
        $shape = new Point(mt_rand(0, 100), mt_rand(0, 100));
        $group = new PrimitiveShapeGroup([$shape]);
        $this->assertTrue($group->has($shape));
    }

    /**
     * Checks if the given shape does not exist in the PrimitiveShapeGroup.
     *
     * @return void
     * @covers \Geometra\Shape\Group\PrimitiveShapeGroup::has
     */
    public function testHasNegative(): void
    {
        $shape1 = new Point(mt_rand(0, 100), mt_rand(0, 100));
        $shape2 = new Point(mt_rand(0, 100), mt_rand(0, 100));
        $group = new PrimitiveShapeGroup([$shape1]);
        $this->assertFalse($group->has($shape2));
    }

    /**
     * Returns the current shape in the PrimitiveShapeGroup.
     *
     * @return void
     * @covers \Geometra\Shape\Group\PrimitiveShapeGroup::current
     */
    public function testCurrentOnEmpty(): void
    {
        $group = new PrimitiveShapeGroup();

        $this->assertNull($group->current());
    }

    /**
     * Returns the current shape in the PrimitiveShapeGroup with non-empty list.
     *
     * @return void
     * @covers \Geometra\Shape\Group\PrimitiveShapeGroup::current
     */
    public function testCurrentOnNonEmpty(): void
    {
        $shape = new Point(mt_rand(0, 100), mt_rand(0, 100));
        $group = new PrimitiveShapeGroup([$shape]);

        $this->assertSame($shape, $group->current());
    }

    /**
     * Returns the key of the current element in the PrimitiveShapeGroup.
     *
     * @return void The key of the current element.
     * @covers \Geometra\Shape\Group\PrimitiveShapeGroup::key
     */
    public function testKeyEmptyList(): void
    {
        $group = new PrimitiveShapeGroup();

        $this->assertSame(0, $group->key());
    }

    /**
     * Returns the key of the current element in the PrimitiveShapeGroup.
     *
     * @return void The key of the current element.
     * @covers \Geometra\Shape\Group\PrimitiveShapeGroup::key
     */
    public function testKeyNonEmptyList(): void
    {
        $shape1 = new Point(mt_rand(0, 100), mt_rand(0, 100));
        $shape2 = new Point(mt_rand(0, 100), mt_rand(0, 100));
        $group = new PrimitiveShapeGroup([$shape1, $shape2]);

        $this->assertSame(0, $group->key());
        $group->next();
        $this->assertSame(1, $group->key());
    }

    /**
     * Checks if the current element in the PrimitiveShapeGroup is valid.
     *
     * @return void True if the current element is valid, false otherwise.
     * @covers \Geometra\Shape\Group\PrimitiveShapeGroup::valid
     */
    public function testValid(): void
    {
        $shape1 = new Point(mt_rand(0, 100), mt_rand(0, 100));
        $shape2 = new Point(mt_rand(0, 100), mt_rand(0, 100));
        $group = new PrimitiveShapeGroup([$shape1, $shape2]);

        $this->assertTrue($group->valid());
        $group->next();
        $this->assertTrue($group->valid());
        $group->next();
        $this->assertFalse($group->valid());
    }

    /**
     * Rewinds the iterator to the first element in the collection.
     *
     * This method resets the iterator position to the beginning of the collection and
     * makes the first element the current element.
     *
     * @return void
     * @covers \Geometra\Shape\Group\PrimitiveShapeGroup::rewind
     */
    public function testRewind(): void
    {
        $shape1 = new Point(mt_rand(0, 100), mt_rand(0, 100));
        $shape2 = new Point(mt_rand(0, 100), mt_rand(0, 100));
        $group = new PrimitiveShapeGroup([$shape1, $shape2]);

        $this->assertTrue(0 === $group->key());
        $group->next();
        $this->assertTrue(0 !== $group->key());
        $group->rewind();
        $this->assertTrue(0 === $group->key());

    }

    /**
     * Asserts that the count of elements in the PrimitiveShapeGroup is zero.
     *
     * This method creates a new PrimitiveShapeGroup with no elements. It then asserts that
     * the count of elements in the empty group is equal to zero.
     *
     * @return void
     * @covers \Geometra\Shape\Group\PrimitiveShapeGroup::count
     */
    public function testCountEmpty(): void
    {
        $group = new PrimitiveShapeGroup();

        $this->assertTrue(0 === $group->count());
    }

    /**
     * Tests the "count" method of the "PrimitiveShapeGroup" class.
     *
     * @return void
     * @covers \Geometra\Shape\Group\PrimitiveShapeGroup::count
     */
    public function testCount(): void
    {
        $shape1 = new Point(mt_rand(0, 100), mt_rand(0, 100));
        $shape2 = new Point(mt_rand(0, 100), mt_rand(0, 100));
        $shape3 = new Point(mt_rand(0, 100), mt_rand(0, 100));
        $group = new PrimitiveShapeGroup([$shape1]);

        $this->assertTrue(1 === $group->count());
        $group->add($shape2);
        $this->assertTrue(2 === $group->count());
        $group->add($shape2);
        $this->assertTrue(2 === $group->count());
        $group->add($shape3);
        $this->assertTrue(3 === $group->count());
    }


    /**
     * Moves the iterator to the next element in the collection.
     *
     * This method increments the iterator position, moving it to the next element in
     * the collection, and sets the next element as the current element.
     *
     * @return void
     * @covers \Geometra\Shape\Group\PrimitiveShapeGroup::next
     */
    public function testNext(): void
    {
        $shape1 = new Point(mt_rand(0, 100), mt_rand(0, 100));
        $shape2 = new Point(mt_rand(0, 100), mt_rand(0, 100));
        $group = new PrimitiveShapeGroup([$shape1, $shape2]);

        $this->assertTrue(0 === $group->key());
        $group->next();
        $this->assertTrue(1 === $group->key());
    }
}
