<?php

namespace Dhii\Espresso\Test\Expression;

use Dhii\Espresso\Expression\OrExpression;
use Dhii\Evaluable\EvaluableInterface;
use Xpmock\TestCase;

/**
 * Tests {@see Dhii\Espresso\Expression\OrExpression}.
 *
 * @since 0.1
 */
class OrExpressionTest extends TestCase
{
    /**
     * Creates an instance of the test subject.
     *
     * @since 0.1
     *
     * @return OrExpression
     */
    public function createInstance(/* array $terms... */)
    {
        $me = $this;

        $termValues = func_get_args();
        $terms      = array_map(function ($val) use ($me) {
            return $me->mockEvaluable($val);
        }, $termValues);

        $exp = new OrExpression($terms);

        return $exp;
    }

    /**
     * Creates a mock evaluable term that evaluates to a given value.
     *
     * @since 0.1
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
     * @since 0.1
     */
    public function testEvaluateNoTerms()
    {
        $subject = $this->createInstance();

        $this->assertFalse($subject->evaluate());
    }

    /**
     * Tests evaluation with one true term.
     *
     * @since 0.1
     */
    public function testEvaluateOneTermTrue()
    {
        $subject = $this->createInstance(true);

        $this->assertTrue($subject->evaluate());
    }

    /**
     * Tests evaluation with one false term.
     *
     * @since 0.1
     */
    public function testEvaluateOneTermFalse()
    {
        $subject = $this->createInstance(false);

        $this->assertFalse($subject->evaluate());
    }

    /**
     * Tests evaluation with two true terms.
     *
     * @since 0.1
     */
    public function testEvaluateTwoTermsTrueTrue()
    {
        $subject = $this->createInstance(true, true);

        $this->assertTrue($subject->evaluate());
    }

    /**
     * Tests evaluation with one true term and one false terms.
     *
     * @since 0.1
     */
    public function testEvaluateTwoTermsTrueFalse()
    {
        $subject = $this->createInstance(true, false);

        $this->assertTrue($subject->evaluate());
    }

    /**
     * Tests evaluation with one false term and one true terms.
     *
     * @since 0.1
     */
    public function testEvaluateTwoTermsFalseTrue()
    {
        $subject = $this->createInstance(false, true);

        $this->assertTrue($subject->evaluate());
    }

    /**
     * Tests evaluation with two false terms.
     *
     * @since 0.1
     */
    public function testEvaluateTwoTermsFalseFalse()
    {
        $subject = $this->createInstance(false, false);

        $this->assertFalse($subject->evaluate());
    }

    /**
     * Tests evaluation with three true terms.
     *
     * @since 0.1
     */
    public function testEvaluateThreeTermsAllTrue()
    {
        $subject = $this->createInstance(true, true, true);

        $this->assertTrue($subject->evaluate());
    }

    /**
     * Tests evaluation with two true terms and one false term.
     *
     * @since 0.1
     */
    public function testEvaluateThreeTermsOneFalse()
    {
        $subject = $this->createInstance(true, true, false);

        $this->assertTrue($subject->evaluate());
    }

    /**
     * Tests evaluation with two false terms and one true term.
     *
     * @since 0.1
     */
    public function testEvaluateThreeTermsTwoFalse()
    {
        $subject = $this->createInstance(true, false, false);

        $this->assertTrue($subject->evaluate());
    }

    /**
     * Tests evaluation with three false terms.
     *
     * @since 0.1
     */
    public function testEvaluateThreeTermsAllFalse()
    {
        $subject = $this->createInstance(false, false, false);

        $this->assertFalse($subject->evaluate());
    }
}
