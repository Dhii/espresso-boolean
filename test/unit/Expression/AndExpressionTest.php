<?php

namespace Dhii\Espresso\Test\Expression;

use Dhii\Espresso\Expression\AndExpression;
use Dhii\Evaluable\EvaluableInterface;
use Xpmock\TestCase;

/**
 * Tests {@see Dhii\Espresso\Expression\AndExpression}.
 *
 * @since [*next-version*]
 */
class AndExpressionTest extends TestCase
{
    /**
     * Creates an instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return AndExpression
     */
    public function createInstance(/* array $terms... */)
    {
        $me = $this;

        $termValues = func_get_args();
        $terms      = array_map(function ($val) use ($me) {
            return $me->mockEvaluable($val);
        }, $termValues);

        $exp = new AndExpression($terms);

        return $exp;
    }

    /**
     * Creates a mock evaluable term that evaluates to a given value.
     *
     * @since [*next-version*]
     *
     * @param bool $val The value to be returned when the term is evaluated.
     *
     * @return EvaluableInterface
     */
    public function mockEvaluable($val)
    {
        $mock = $this->mock('Dhii\\Evaluable\\EvaluableInterface')
            ->evaluate($val);

        return $mock->new();
    }

    /**
     * Tests evaluation with no terms.
     *
     * @since [*next-version*]
     */
    public function testEvaluateNoTerms()
    {
        $subject = $this->createInstance();

        $this->assertFalse($subject->evaluate());
    }

    /**
     * Tests evaluation with one true term.
     *
     * @since [*next-version*]
     */
    public function testEvaluateOneTermTrue()
    {
        $subject = $this->createInstance(true);

        $this->assertTrue($subject->evaluate());
    }

    /**
     * Tests evaluation with one false term.
     *
     * @since [*next-version*]
     */
    public function testEvaluateOneTermFalse()
    {
        $subject = $this->createInstance(false);

        $this->assertFalse($subject->evaluate());
    }

    /**
     * Tests evaluation with two true terms.
     *
     * @since [*next-version*]
     */
    public function testEvaluateTwoTermsTrueTrue()
    {
        $subject = $this->createInstance(true, true);

        $this->assertTrue($subject->evaluate());
    }

    /**
     * Tests evaluation with one true term and one false terms.
     *
     * @since [*next-version*]
     */
    public function testEvaluateTwoTermsTrueFalse()
    {
        $subject = $this->createInstance(true, false);

        $this->assertFalse($subject->evaluate());
    }

    /**
     * Tests evaluation with one false term and one true terms.
     *
     * @since [*next-version*]
     */
    public function testEvaluateTwoTermsFalseTrue()
    {
        $subject = $this->createInstance(false, true);

        $this->assertFalse($subject->evaluate());
    }

    /**
     * Tests evaluation with two false terms.
     *
     * @since [*next-version*]
     */
    public function testEvaluateTwoTermsFalseFalse()
    {
        $subject = $this->createInstance(false, false);

        $this->assertFalse($subject->evaluate());
    }

    /**
     * Tests evaluation with three true terms.
     *
     * @since [*next-version*]
     */
    public function testEvaluateThreeTermsAllTrue()
    {
        $subject = $this->createInstance(true, true, true);

        $this->assertTrue($subject->evaluate());
    }

    /**
     * Tests evaluation with two true terms and one false term.
     *
     * @since [*next-version*]
     */
    public function testEvaluateThreeTermsOneFalse()
    {
        $subject = $this->createInstance(true, true, false);

        $this->assertFalse($subject->evaluate());
    }

    /**
     * Tests evaluation with two false terms and one true term.
     *
     * @since [*next-version*]
     */
    public function testEvaluateThreeTermsTwoFalse()
    {
        $subject = $this->createInstance(true, false, false);

        $this->assertFalse($subject->evaluate());
    }

    /**
     * Tests evaluation with three false terms.
     *
     * @since [*next-version*]
     */
    public function testEvaluateThreeTermsAllFalse()
    {
        $subject = $this->createInstance(false, false, false);

        $this->assertFalse($subject->evaluate());
    }
}
