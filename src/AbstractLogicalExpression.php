<?php

namespace Dhii\Espresso;

use Dhii\Data\ValueAwareInterface;

/**
 * An abstract implementation of a logical expression.
 *
 * @since [*next-version*]
 */
abstract class AbstractLogicalExpression extends AbstractOperatorExpression implements LogicalExpressionInterface
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
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function isNegated()
    {
        return (bool) $this->negated;
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
