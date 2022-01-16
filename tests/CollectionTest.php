<?php

declare(strict_types=1);

namespace Oscmarb\Collection\Tests;

use Oscmarb\Collection\Collection;
use PHPUnit\Framework\TestCase;

final class CollectionTest extends TestCase
{
    public function test_try_create_a_collection_with_invalid_element(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        SerializableTypedCollection::from([Collection::empty()]);
    }

    public function test_should_create_a_collection_with_valid_elements(): void
    {
        $elements = ['first' => new Item(\random_bytes(10)), 'second' => new Item(\random_bytes(10))];

        $collection = ItemTypedCollection::from($elements);

        self::assertEquals($elements, $collection->toArray());
    }
}

class ItemTypedCollection extends Collection
{
    protected function type(): ?string
    {
        return Item::class;
    }
}

class Item
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}

class SerializableTypedCollection extends Collection
{
    protected function type(): ?string
    {
        return Item::class;
    }
}