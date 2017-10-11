<?php

namespace RebelCode\Bookings;

use Dhii\Util\String\StringableInterface as Stringable;
use Exception as RootException;
use InvalidArgumentException;

/**
 * Common functionality for something that is aware of a status.
 *
 * @since [*next-version*]
 */
trait StatusAwareTrait
{
    /**
     * The status.
     *
     * @since [*next-version*]
     *
     * @var string|Stringable
     */
    protected $status;

    /**
     * Retrieves the status associated with this instance.
     *
     * @since [*next-version*]
     *
     * @return Stringable|string The status.
     */
    protected function _getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the status for this instance.
     *
     * @since [*next-version*]
     *
     * @param string|Stringable|null $status The status to set.
     */
    protected function _setStatus($status)
    {
        if ($status !== null && !is_string($status) && !($status instanceof Stringable)) {
            throw $this->_createInvalidArgumentException(
                $this->__('Argument is not a valid string or stringable object'),
                null,
                null,
                $status
            );
        }

        $this->status = $status;
    }

    /**
     * Creates a new invalid argument exception.
     *
     * @since [*next-version*]
     *
     * @param string|Stringable|null $message  The error message, if any.
     * @param int|null               $code     The error code, if any.
     * @param RootException|null     $previous The inner exception for chaining, if any.
     * @param mixed|null             $argument The invalid argument, if any.
     *
     * @return InvalidArgumentException The new exception.
     */
    abstract protected function _createInvalidArgumentException(
        $message = null,
        $code = null,
        RootException $previous = null,
        $argument = null
    );

    /**
     * Translates a string, and replaces placeholders.
     *
     * @since [*next-version*]
     *
     * @param string $string  The format string to translate.
     * @param array  $args    Placeholder values to replace in the string.
     * @param mixed  $context The context for translation.
     *
     * @return string The translated string.
     */
    abstract protected function __($string, $args = [], $context = null);
}
