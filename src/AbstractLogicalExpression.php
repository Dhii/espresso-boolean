<?php

namespace Dhii\Espresso;

use Dhii\Data\ValueAwareInterface;
use Dhii\Expression\AbstractLeftAssocOperatorExpression;

/**
 * An abstract implementation of a logical expression.
 *
 * @since [*next-version*]
 */
abstract class AbstractLogicalExpression extends AbstractLeftAssocOperatorExpression
{
    /**
     * Evaluates to false if expression has no terms.
     *
     * @since [*next-version*]
     */
    const DEFAULT_VALUE = false;

    /**
     * The negation flag.
     *
     * @since [*next-version*]
     *
     * @var bool
     */
    protected $negated;

    /**
     * Gets whether or not the expression is negated.
     *
     * @since [*next-version*]
     *
     * @return bool True if the expression is negated, false if not.
     */
    protected function _isNegated()
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
    protected function _setNegated($negated)
    {
        $this->negated = $negated;

        return $this;
    }

    /**
     * Evaluates the expression.
     *
     * @since [*next-version*]
     *
     * @param ValueAwareInterface $ctx [optional] The context. Default: null
     *
     * @return bool The result.
     */
    protected function _evaluate(ValueAwareInterface $ctx = null)
    {
        return $this->_isNegated() xor parent::_evaluate($ctx);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _defaultValue(ValueAwareInterface $ctx = null)
    {
        return static::DEFAULT_VALUE;
    }
}
