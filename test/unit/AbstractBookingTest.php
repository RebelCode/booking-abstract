<?php

namespace RebelCode\Bookings\UnitTest;

use PHPUnit_Framework_MockObject_MockObject;
use Dhii\Time\PeriodInterface;
use Dhii\Time\TimeInterface;
use Xpmock\TestCase;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class AbstractBookingTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'RebelCode\Bookings\AbstractBooking';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @param array $methods The methods to mock.
     *
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    public function createInstance(array $methods = [])
    {
        $mock = $this->getMockBuilder(static::TEST_SUBJECT_CLASSNAME);

        $mock->setMethods(array_merge($methods, ['_getPeriod']));

        return $mock->getMockForAbstractClass();
    }

    /**
     * Creates a mocked period instance for testing purposes.
     *
     * @since [*next-version*]
     *
     * @param TimeInterface|null $start    The start time.
     * @param TimeInterface|null $end      The end time.
     * @param int|null           $duration The duration.
     *
     * @return PeriodInterface
     */
    public function createPeriod($start = null, $end = null, $duration = null)
    {
        return $this->mock('Dhii\Time\PeriodInterface')
                    ->getStart($start)
                    ->getEnd($end)
                    ->getDuration($duration)
                    ->new();
    }

    /**
     * Creates a mocked time object for testing purposes.
     *
     * @since [*next-version*]
     *
     * @param int $timestamp The timestamp.
     *
     * @return TimeInterface
     */
    public function createTime($timestamp)
    {
        return $this->mock('Dhii\Time\TimeInterface')
                    ->getTimestamp($timestamp)
                    ->new();
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance();

        $this->assertInstanceOf(
            static::TEST_SUBJECT_CLASSNAME,
            $subject,
            'A valid instance of the test subject could not be created.'
        );
    }

    /**
     * Tests the start getter method to ensure that the start time matches that of the period.
     *
     * @since [*next-version*]
     */
    public function testGetStart()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $period = $this->createPeriod(
            $start = $this->createTime(rand(0, time()))
        );

        $subject->expects($this->once())
                ->method('_getPeriod')
                ->willReturn($period);

        $this->assertSame($start, $reflect->_getStart(), 'Booking and period start times are not the same.');
    }

    /**
     * Tests the end getter method to ensure that the end time matches that of the period.
     *
     * @since [*next-version*]
     */
    public function testGetEnd()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $period = $this->createPeriod(
            null,
            $end = $this->createTime(rand(0, time()))
        );

        $subject->expects($this->once())
                ->method('_getPeriod')
                ->willReturn($period);

        $this->assertSame($end, $reflect->_getEnd(), 'Booking and period end times are not the same.');
    }

    /**
     * Tests the duration getter method to ensure that the duration matches that of the period.
     *
     * @since [*next-version*]
     */
    public function testGetDuration()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $period = $this->createPeriod(
            null,
            null,
            $duration = rand(0, time())
        );

        $subject->expects($this->once())
                ->method('_getPeriod')
                ->willReturn($period);

        $this->assertEquals($duration, $reflect->_getDuration(), 'Booking and period durations are not equal.');
    }

    public function testNull()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        var_dump($reflect->_getPeriod());
    }
}
