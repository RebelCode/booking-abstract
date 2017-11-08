<?php

namespace RebelCode\Bookings\FuncTest;

use PHPUnit_Framework_MockObject_MockObject;
use RebelCode\Bookings\BookingInterface;
use stdClass;
use Xpmock\TestCase;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class BookingAwareTraitTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'RebelCode\Bookings\BookingAwareTrait';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return PHPUnit_Framework_MockObject_MockObject The created mock instance.
     */
    public function createInstance()
    {
        // Create mock
        $mock = $this->getMockBuilder(static::TEST_SUBJECT_CLASSNAME)
                     ->setMethods(['__', '_createInvalidArgumentException'])
                     ->getMockForTrait();

        $mock->method('__')->willReturnArgument(0);
        $mock->method('_createInvalidArgumentException')->willReturnCallback(
            function($msg, $code = 0, $prev = null, $arg = null) {
                return new \InvalidArgumentException($msg, $code, $prev);
            }
        );

        return $mock;
    }

    /**
     * Creates a mock booking instance for testing purposes.
     *
     * @since [*next-version*]
     *
     * @return BookingInterface The created booking.
     */
    public function createBooking()
    {
        $mock = $this->mock('RebelCode\Bookings\BookingInterface')
                     ->getStart()
                     ->getEnd()
                     ->getDuration()
                     ->getStatus();

        return $mock->new();
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance();

        $this->assertInternalType(
            'object',
            $subject,
            'An instance of the test subject could not be created'
        );
    }

    /**
     * Tests the booking getter and setter methods to ensure correct assignment and retrieval.
     *
     * @since [*next-version*]
     */
    public function testGetSetBooking()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $reflect->_setBooking($booking = $this->createBooking());

        $this->assertSame($booking, $reflect->_getBooking(), 'Set and retrieved bookings are not the same.');
    }

    /**
     * Tests the booking getter and setter methods with a null value to ensure correct assignment and retrieval.
     *
     * @since [*next-version*]
     */
    public function testGetSetBookingNull()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $reflect->_setBooking(null);

        $this->assertNull($reflect->_getBooking(), 'Retrieved booking is not null.');
    }

    /**
     * Tests the booking setter method with an invalid value to assert whether an exception is thrown.
     *
     * @since [*next-version*]
     */
    public function testGetSetBookingInvalid()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $this->setExpectedException('InvalidArgumentException');

        $reflect->_setBooking(new stdClass());
    }
}
