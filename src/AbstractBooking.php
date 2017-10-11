<?php

namespace RebelCode\Bookings;

use Dhii\Time\PeriodInterface;
use Dhii\Time\TimeInterface;

/**
 * Abstract common functionality for bookings.
 *
 * @since [*next-version*]
 */
abstract class AbstractBooking
{
    /**
     * Retrieves the booking period.
     *
     * @since [*next-version*]
     *
     * @return PeriodInterface The period instance.
     */
    abstract protected function _getPeriod();

    /**
     * Retrieves the start time of the booking.
     *
     * @since [*next-version*]
     *
     * @return TimeInterface The start time.
     */
    protected function _getStart()
    {
        return $this->_getPeriod()->getStart();
    }

    /**
     * Retrieves the end time of the booking.
     *
     * @since [*next-version*]
     *
     * @return TimeInterface The end time.
     */
    protected function _getEnd()
    {
        return $this->_getPeriod()->getEnd();
    }

    /**
     * Retrieves the duration of the booking.
     *
     * @since [*next-version*]
     *
     * @return int The duration, in seconds.
     */
    protected function _getDuration()
    {
        return $this->_getPeriod()->getDuration();
    }
}
