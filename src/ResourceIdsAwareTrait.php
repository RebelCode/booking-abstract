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
     * @var int[]|string[]|Stringable[]
     */
    protected $resourceIds;

    /**
     * Retrieves the resource IDs associated with this intance.
     *
     * @since [*next-version*]
     *
     * @return int[]|string[]|Stringable[] The list of resource IDs.
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
     * @param int[]|string[]|Stringable[] $ids The resource IDs to set.
     *
     * @throws InvalidArgumentException If the argument is not valid.
     */
    protected function _setResourceIds($ids)
    {
        $this->resourceIds = $this->_normalizeArray($ids);
    }

    /**
     * Normalizes a value into an array.
     *
     * @since [*next-version*]
     *
     * @param array|stdClass|Traversable $value The value to normalize.
     *
     * @throws InvalidArgumentException If value cannot be normalized.
     *
     * @return array The normalized value.
     */
    abstract protected function _normalizeArray($value);
}
