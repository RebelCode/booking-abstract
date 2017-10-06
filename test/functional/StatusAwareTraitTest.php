<?php

namespace RebelCode\Bookings\FuncTest;

use InvalidArgumentException;
use PHPUnit_Framework_MockObject_MockObject;
use stdClass;
use Xpmock\TestCase;
use RebelCode\Bookings\StatusAwareTrait as TestSubject;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class StatusAwareTraitTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'RebelCode\Bookings\StatusAwareTrait';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    public function createInstance()
    {
        // Create mock
        $mock = $this->getMockBuilder(static::TEST_SUBJECT_CLASSNAME)
                     ->setMethods(
                         [
                             '__',
                             '_createInvalidArgumentException',
                         ]
                     )
                     ->getMockForTrait();

        $mock->method('__')->willReturnArgument(0);
        $mock->method('_createInvalidArgumentException')->willReturnCallback(
            function ($msg = '', $code = null, $prev = null) {
                return new InvalidArgumentException($msg, $code, $prev);
            }
        );

        return $mock;
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
     * Tests the status getter and setter methods to ensure correct value assignment and retrieval.
     *
     * @since [*next-version*]
     */
    public function testGetSetStatus()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $status = uniqid('status-');

        $reflect->_setStatus($status);

        $this->assertEquals($status, $reflect->_getStatus(), 'Set and retrieved statuses are not equal.');
    }

    /**
     * Tests the status getter and setter methods with as stringable object.
     *
     * @since [*next-version*]
     */
    public function testGetSetStatusStringable()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $status = $this->mock('Dhii\Util\String\StringableInterface')
                       ->__toString()
                       ->new();

        $reflect->_setStatus($status);

        $this->assertEquals($status, $reflect->_getStatus(), 'Set and retrieved statuses are not equal.');
    }

    /**
     * Tests the status getter and setter methods with an invalid value.
     *
     * @since [*next-version*]
     */
    public function testGetSetStatusInvalid()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $status = new stdClass();

        $subject->expects($this->once())->method('__');
        $subject->expects($this->once())->method('_createInvalidArgumentException')
                ->with($this->anything(), $this->anything(), $this->anything(), $status);

        $this->setExpectedException('InvalidArgumentException');

        $reflect->_setStatus($status);
    }
}
