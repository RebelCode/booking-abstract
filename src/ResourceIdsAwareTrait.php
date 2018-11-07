<?php

namespace RebelCode\Bookings;

use Dhii\Util\String\StringableInterface as Stringable;
use InvalidArgumentException;
use stdClass;
use Traversable;

/**
 * Common functionality for objects that are aware of resource IDs.
 *
 * @since [*next-version*]
 */
trait ResourceIdsAwareTrait
{
    /**
     * The resource IDs.
     *
     * @since [*next-version*]
     *
     * @var int[]|string[]|Stringable[]|stdClass|Traversable
     */
    protected $resourceIds;

    /**
     * Retrieves the resource IDs associated with this intance.
     *
     * @since [*next-version*]
     *
     * @return int[]|string[]|Stringable[]|stdClass|Traversable The list of resource IDs.
     */
    protected function _getResourceIds()
    {
        return $this->resourceIds;
    }

    /**
     * Sets the resource IDs for this instance.
     *
     * @since [*next-version*]
     *
     * @param int[]|string[]|Stringable[]|stdClass|Traversable $ids The resource IDs to set.
     *
     * @throws InvalidArgumentException If the argument is not valid.
     */
    protected function _setResourceIds($ids)
    {
        $this->resourceIds = $this->_normalizeIterable($ids);
    }

    /**
     * Normalizes an iterable.
     *
     * Makes sure that the return value can be iterated over.
     *
     * @since [*next-version*]
     *
     * @param mixed $iterable The iterable to normalize.
     *
     * @throws InvalidArgumentException If the iterable could not be normalized.
     *
     * @return array|Traversable|stdClass The normalized iterable.
     */
    abstract protected function _normalizeIterable($iterable);
}
