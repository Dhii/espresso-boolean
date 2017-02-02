<?php

namespace Dhii\Espresso;

use Dhii\Data\ValueAwareInterface;

/**
 * An abstract implementation of a logical expression.
 *
 * @since 0.1
 */
abstract class AbstractLogicalExpression extends AbstractOperatorExpression implements LogicalExpressionInterface
{
    /**
     * Evaluates to false if expression has no terms.
     *
     * @since 0.1
     */
    const DEFAULT_VALUE = false;

    /**
     * The negation flag.
     *
     * @since 0.1
     *
     * @var bool
     */
    protected $negated;

    /**
     * {@inheritdoc}
     *
     * @since 0.1
     */
    public function isNegated()
    {
        return (bool) $this->negated;
    }

    /**
     * Sets the expression's negation.
     *
     * @since 0.1
     *
     * @param bool $negated True to negate the expression, false otherwise.
     *
     * @return $this This instance.
     */
    public function _setNegated($negated)
    {
        $this->negated = $negated;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1
     */
    public function evaluate(ValueAwareInterface $ctx = null)
    {
        return $this->isNegated() xor parent::evaluate($ctx);
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1
     */
    protected function _defaultValue(ValueAwareInterface $ctx = null)
    {
        return static::DEFAULT_VALUE;
    }
}
