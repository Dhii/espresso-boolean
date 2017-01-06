<?php

namespace Dhii\Espresso\Expression;

use \Dhii\Espresso\AbstractLogicalExpression;

/**
 * A logical AND expression.
 *
 * @since [*next-version*]
 */
class AndExpression extends AbstractLogicalExpression
{
    /**
     * Constructor.
     *
     * @since [*next-version*]
     *
     * @param array $terms   [optional] An array of evaluable terms. Default: array()
     * @param bool  $negated [optional] True to negate the expression, false otherwise.
     */
    public function __construct(array $terms = array(), $negated = false)
    {
        $this->setTerms($terms)
            ->setNegated($negated);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function _compare($left, $right)
    {
        return $left && $right;
    }
}
