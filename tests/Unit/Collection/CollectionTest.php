<?php

declare(strict_types=1);

namespace Kevinfrom\EconomicApi\Tests\Unit\Collection;

use Kevinfrom\EconomicApi\Data\Collection\Collection;
use PHPUnit\Framework\TestCase;

final class CollectionTest extends TestCase
{
    public function testCreateNewCollection(): void
    {
        $expectedCount = 10;
        $items = array_fill(0, $expectedCount, 'item');

        $collection = new Collection($items);

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertEquals($expectedCount, $collection->count());

        $this->assertIsArray($collection->toArray());

        $this->assertEmpty(array_diff($items, $collection->toArray()));
    }

    public function testCollectionCount(): void
    {
        $expectedCount = 10;
        $items = array_fill(0, $expectedCount, 'item');

        $collection = new Collection($items);
        $this->assertEquals($expectedCount, $collection->count());
    }

    public function testAppend(): void
    {
        $expectedCount = 10;
        $items = array_fill(0, $expectedCount - 1, 'item');

        $collection = new Collection($items);

        $itemToAppend = 'append';
        $collection->append($itemToAppend);

        $this->assertEquals($expectedCount, $collection->count());
        $this->assertEquals($itemToAppend, $collection->last());
    }

    public function testPrepend(): void
    {
        $items = array_fill(0, 10, 'item');

        $collection = new Collection($items);

        $itemToPrepend = 'prepend';
        $collection->prepend($itemToPrepend);
        $this->assertEquals(10, $collection->count());

        $collection = $collection->prepend($itemToPrepend);
        $this->assertEquals(11, $collection->count());
        $this->assertEquals($itemToPrepend, $collection->first());
    }

    public function testLimit(): void
    {
        $items = array_fill(0, 10, 'item');

        $collection = new Collection($items);

        $this->assertEquals(10, $collection->count());

        $collection->limit(5);
        $this->assertEquals(10, $collection->count());

        $collection = $collection->limit(5);
        $this->assertEquals(5, $collection->count());
    }

    public function testFilter(): void
    {
        $items = [];
        for ($i = 1; $i <= 10; $i++) {
            $items[] = $i;
        }

        $collection = new Collection($items);

        $this->assertEquals(10, $collection->count());

        $collection->filter(fn($item) => $item % 2 === 1);
        $this->assertEquals(10, $collection->count());

        $collection = $collection->filter(fn($item) => $item % 2 === 1);
        $this->assertEquals(5, $collection->count());
    }
}
