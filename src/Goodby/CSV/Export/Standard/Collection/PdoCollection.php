<?php

namespace Goodby\CSV\Export\Standard\Collection;

use Iterator;
use PDO;
use ReturnTypeWillChange;

class PdoCollection implements Iterator
{
    /**
     * @var \PDOStatement
     */
    private $stmt;

    private $rowCount;

    private $current = 0;

    public function __construct(\PDOStatement $stmt)
    {
        $this->stmt = $stmt;

        $this->rowCount = $this->stmt->rowCount();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    #[ReturnTypeWillChange]
    public function current()
    {
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    #[ReturnTypeWillChange]
    public function next()
    {
        $this->current++;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    #[ReturnTypeWillChange]
    public function key()
    {
        $this->current;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    #[ReturnTypeWillChange]
    public function valid()
    {
        return ($this->rowCount > $this->current);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    #[ReturnTypeWillChange]
    public function rewind()
    {
        $this->stmt->execute();
        $this->current = 0;
    }
}
