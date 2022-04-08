<?php

namespace Goodby\CSV\Export\Tests\Standard\Unit\Collection;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

class SampleAggIterator implements IteratorAggregate
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->data);
    }
}
