<?php

namespace Dhii\Espresso\FuncTest;

use Dhii\Espresso\AbstractGenericLogicalExpression;
use Dhii\Evaluable\EvaluableInterface;
use Xpmock\TestCase;

/**
 * Tests {@see Dhii\Espresso\AbstractGenericLogicalExpression}.
 *
 * @since [*next-version*]
 */
class AbstractGenericLogicalExpressionTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\Espresso\\AbstractGenericLogicalExpression';

    /**
     * The name of the evaluable term interface.
     *
     * @since [*next-version*]
     */
    const EVALUABLE_CLASSNAME = 'Dhii\\Evaluable\\EvaluableInterface';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @param mixed $evaluation The evaluation result.
     *
     * @return AbstractGenericLogicalExpression
     */
    public function createInstance($evaluation = null)
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->_operator()
            ->_eval($evaluation)
            ->new();

        return $mock;
    }

    /**
     * Creates a mock expression term for testing purposes.
     *
     * @since [*next-version*]
     *
     * @param mixed $return [optional] The value the term evaluates to. Default: null
     *
     * @return EvaluableInterface The new mocked term instance.
     */
    public function createEvaluable($return = null)
    {
        return $this->mock(static::EVALUABLE_CLASSNAME)
            ->evaluate($return)
            ->new();
    }

    /**
     * Tests the initialization method.
     *
     * @since [*next-version*]
     */
    public function testInit()
    {
        $subject = $this->createInstance();

        $subject->this()->_init(array(), false);

        $this->assertEmpty($subject->this()->terms);
        $this->assertFalse($subject->this()->negated);
    }

    /**
     * Tests the terms getter method to ensure all terms are returned.
     *
     * @since [*next-version*]
     */
    public function testGetTerms()
    {
        $subject = $this->createInstance();

        $subject->this()->_init(array(), false);

        $this->assertEmpty($subject->getTerms());

        $expected = $subject->this()->terms = array(
            $this->createEvaluable(5),
            $this->createEvaluable(2),
        );

        $this->assertEquals($expected, $subject->getTerms());
    }

    /**
     * Tests the single term getter method to ensure that the correct term is returned.
     *
     * @since [*next-version*]
     */
    public function testGetTerm()
    {
        $subject = $this->createInstance();

        $subject->this()->terms = array(
            $this->createEvaluable(5),
            $this->createEvaluable(2),
        );

        $this->assertEquals($this->createEvaluable(5), $subject->getTerm(0));
        $this->assertEquals($this->createEvaluable(2), $subject->getTerm(1));
    }

    /**
     * Tests whether terms are correctly added to the expression.
     *
     * @since 0.1
     */
    public function testAddTerm()
    {
        $subject = $this->createInstance();

        $term = $this->createEvaluable();
        $subject->addTerm($term);

        $this->assertEquals(array($term), $subject->this()->terms);
    }

    /**
     * Tests whether terms are correctly removed from the expression.
     *
     * @since 0.1
     */
    public function testRemoveTerm()
    {
        $subject = $this->createInstance();

        $terms = array(
            $this->createEvaluable(),
            $this->createEvaluable(),
            $this->createEvaluable(),
        );

        $subject->this()->terms = $terms;

        $subject->removeTerm(1);

        // Remove term at index 1 and re-index array
        unset($terms[1]);
        $terms = array_values($terms);

        $this->assertEquals($terms, $subject->this()->terms);
    }

    /**
     * Tests the single term getter method after terms have been removed from the expression.
     *
     * @since [*next-version*]
     */
    public function testGetTermAfterRemoval()
    {
        $subject = $this->createInstance();

        $subject->this()->terms = array(
            $this->createEvaluable(5),
            $this->createEvaluable(2),
            $this->createEvaluable(9),
        );

        $subject->removeTerm(1);

        $this->assertEquals($this->createEvaluable(9), $subject->getTerm(1));
    }

    /**
     * Tests whether terms are correctly set to the expression.
     *
     * @since 0.1
     */
    public function testSetTerms()
    {
        $subject = $this->createInstance();

        $terms = array(
            $this->createEvaluable(),
            $this->createEvaluable(),
            $this->createEvaluable(),
        );

        $subject->setTerms($terms);

        $this->assertEquals($terms, $subject->this()->terms);
    }

    /**
     * Tests whether existing terms are correctly overwritten when new terms are set.
     *
     * @since 0.1
     */
    public function testSetTermsWithExistingTerms()
    {
        $subject = $this->createInstance();

        $subject->this()->terms = array($this->createEvaluable());

        $terms = array(
            $this->createEvaluable(),
            $this->createEvaluable(),
            $this->createEvaluable(),
        );

        $subject->setTerms($terms);

        $this->assertEquals($terms, $subject->this()->terms);
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
        $this->assertFalse($subject->isNegated());

        $subject->this()->negated = true;
        $this->assertTrue($subject->isNegated());
    }

    /**
     * Tests the negation setter method.
     *
     * @since [*next-version*]
     */
    public function testSetNegated()
    {
        $subject = $this->createInstance();

        $subject->setNegated(false);
        $this->assertFalse($subject->this()->negated = false);

        $subject->this()->_setNegated(true);
        $this->assertTrue($subject->this()->negated = true);
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
}
