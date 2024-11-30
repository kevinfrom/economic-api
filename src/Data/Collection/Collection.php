<?php

declare(strict_types=1);

namespace Kevinfrom\EconomicApi\Data\Collection;

/**
 * @template T
 */
final class Collection
{
    /**
     * @param T[] $items
     */
    public function __construct(private array $items)
    {
    }

    /**
     * Get the count of items in the collection.
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Append an item to the collection.
     *
     * @param T $item
     *
     * @return $this
     */
    public function append(mixed $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Prepend an item to the collection.
     *
     * @param T $item
     *
     * @return $this
     */
    public function prepend(mixed $item): self
    {
        $newItems = $this->items;
        array_unshift($newItems, $item);

        return new self($newItems);
    }

    /**
     * Get the first item from the collection.
     *
     * @return T|null
     */
    public function first()
    {
        return $this->items[0] ?? null;
    }

    /**
     * Get the last item from the collection.
     *
     * @return T|null
     */
    public function last()
    {
        return $this->items[count($this->items) - 1] ?? null;
    }

    /**
     * Limit the collection items to the given number. Returns a new instance.
     *
     * @param int $limit
     *
     * @return self<T>
     */
    public function limit(int $limit): self
    {
        $newItems = array_slice($this->items, 0, $limit);

        return new self($newItems);
    }

    /**
     * Filter the collection items using the given callback. Returns a new instance.
     *
     * @param callable $callback
     *
     * @return self<T>
     */
    public function filter(callable $callback): self
    {
        $newItems = array_filter($this->items, $callback);

        return new self($newItems);
    }

    /**
     * Get items as an array.
     *
     * @return T[]
     */
    public function toArray(): array
    {
        return $this->items;
    }
}
