<?php

namespace RebelCode\Bookings\FuncTest;

use \InvalidArgumentException;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use Xpmock\TestCase;
use RebelCode\Bookings\ResourceIdsAwareTrait as TestSubject;

/**
 * Tests {@see TestSubject}.
 *
 * @since 0.1
 */
class ResourceIdsAwareTraitTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since 0.1
     */
    const TEST_SUBJECT_CLASSNAME = 'RebelCode\Bookings\ResourceIdsAwareTrait';

    /**
     * Creates a new instance of the test subject.
     *
     * @since 0.1
     *
     * @return MockObject
     */
    public function createInstance()
    {
        // Create mock
        $mock = $this->getMockBuilder(static::TEST_SUBJECT_CLASSNAME)
                     ->setMethods(['_normalizeIterable'])
                     ->getMockForTrait();

        return $mock;
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since 0.1
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
     * Tests the getter and setter methods to ensure correct assignment and retrieval.
     *
     * @since 0.1
     */
    public function testGetSetResourceIds()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);
        $input   = [uniqid('id-'), uniqid('id-')];

        $normalized = [uniqid('id-'), uniqid('id-')];
        $subject->expects($this->once())
                ->method('_normalizeIterable')
                ->with($input)
                ->willReturn($normalized);

        $reflect->_setResourceIds($input);

        $this->assertSame($normalized, $reflect->_getResourceIds(), 'Set and retrieved value are not the same.');
    }

    /**
     * Tests the getter and setter methods with an invalid value to assert whether an exception is thrown.
     *
     * @since 0.1
     */
    public function testGetSetResourceIdsInvalid()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);
        $input   = uniqid('invalid-');

        $subject->expects($this->once())
                ->method('_normalizeIterable')
                ->with($input)
                ->willThrowException(new InvalidArgumentException());

        $this->setExpectedException('InvalidArgumentException');

        $reflect->_setResourceIds($input);
    }
}
