<?php

namespace RebelCode\Bookings;

use Dhii\Util\String\StringableInterface as Stringable;
use Exception as RootException;
use InvalidArgumentException;

/**
 * Common functionality for objects that are aware of a booking.
 *
 * @since [*next-version*]
 */
trait BookingAwareTrait
{
    /**
     * The booking instance.
     *
     * @since [*next-version*]
     *
     * @var BookingInterface|null
     */
    protected $booking;

    /**
     * Retrieves the booking instance associated with this instance.
     *
     * @since [*next-version*]
     *
     * @return BookingInterface|null The booking instance, if any.
     */
    protected function _getBooking()
    {
        return $this->booking;
    }

    /**
     * Sets the booking instance for this instance.
     *
     * @since [*next-version*]
     *
     * @param BookingInterface|null $booking The booking instance, or null.
     */
    protected function _setBooking($booking)
    {
        if ($booking !== null && !($booking instanceof BookingInterface)) {
            throw $this->_createInvalidArgumentException(
                $this->__('Argument is not a valid booking.'),
                null,
                null,
                $booking
            );
        }

        $this->booking = $booking;
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
