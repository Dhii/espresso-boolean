<?php

namespace Dhii\Espresso;

/**
 * An abstract implementation of a logical expression.
 *
 * @since [*next-version*]
 */
abstract class AbstractLogicalExpression extends AbstractGenericExpression implements LogicalExpressionInterface
{
    /**
     * The negation flag.
     *
     * @since [*next-version*]
     *
     * @var bool
     */
    protected $negated;

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function isNegated()
    {
        return (bool) $this->negated;
    }

    /**
     * Sets the expression's negation.
     *
     * @since [*next-version*]
     *
     * @param bool $negated True to negate the expression, false otherwise.
     *
     * @return $this This instance.
     */
    public function setNegated($negated)
    {
        $this->negated = $negated;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function evaluate(ValueAwareInterface $ctx = null)
    {
        $terms = $this->getTerms();

        // If expression has terms, set result to first term
        $result = count($terms) > 0
            ? $this->_boolCast($terms[0]->evaluate($ctx))
            : false;

        for ($i = 1; $i < count($terms); ++$i) {
            $leftOperand = $result;
            $rightOperand = $this->_boolCast($terms[$i]->evaluate($ctx));
            // Evaluate using previous result and next term
            $result = $this->_evaluate($leftOperand, $rightOperand);
        }

        return $result;
    }

    /**
     * Evaluates the logical expression given the two operands.
     *
     * @since [*next-version*]
     *
     * @param bool $left The left operand.
     * @param bool $right The right operand.
     *
     * @return bool The result.
     */
    abstract protected function _evaluate($left, $right);

    /**
     * Explicitly casts a value into a boolean.
     *
     * @since [*next-version*]
     *
     * @param mixed $val The value to cast.
     *
     * @return bool The casted boolean value.
     */
    protected function _boolCast($val)
    {
        return (bool) $val;
    }
}
