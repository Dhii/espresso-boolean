<?php

namespace Dhii\Espresso\FuncTest;

use Dhii\Espresso\AbstractLogicalExpression;
use Xpmock\TestCase;

/**
 * Tests {@see Dhii\Espresso\AbstractLogicalExpression}.
 *
 * @since [*next-version*]
 */
class AbstractLogicalExpressionTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\Espresso\\AbstractLogicalExpression';

    /**
     * Creates a new instance of the test subject.
     *
     * @param mixed $evaluation The evaluation result.
     *
     * @return AbstractLogicalExpression The created instance.
     */
    public function createInstance($evaluation = null)
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->_operator(function ($left, $right) {
                return $left && $right;
            })
            ->_eval(function () use ($evaluation) {
                return $evaluation;
            })
            ->new();

        return $mock;
    }

    /**
     * Tests the negation checker method.
     *
     * @since [*next-version*]
     */
    public function testIsNegated()
    {
        $subject = $this->createInstance();

        $subject->this()->negated = false;
        $this->assertFalse($subject->this()->_isNegated());

        $subject->this()->negated = true;
        $this->assertTrue($subject->this()->_isNegated());
    }

    /**
     * Tests the negation setter method.
     *
     * @since [*next-version*]
     */
    public function testSetNegated()
    {
        $subject = $this->createInstance();

        $subject->this()->_setNegated(false);
        $this->assertFalse($subject->this()->negated = false);

        $subject->this()->_setNegated(true);
        $this->assertTrue($subject->this()->negated = true);
    }

    /**
     * Tests the evaluation to ensure that the negation works.
     *
     * @since [*next-version*]
     */
    public function testEvaluate()
    {
        $subject = $this->createInstance(true);

        $subject->this()->_setNegated(false);
        $this->assertTrue($subject->this()->_evaluate());

        $subject->this()->_setNegated(true);
        $this->assertFalse($subject->this()->_evaluate());
    }

    /**
     * Tests the default value getter.
     *
     * @since [*next-version*]
     */
    public function testDefaultValue()
    {
        $subject = $this->createInstance();

        $this->assertFalse($subject->this()->_defaultValue());
    }
}
