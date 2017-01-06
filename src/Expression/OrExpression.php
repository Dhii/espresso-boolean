<?php

namespace Dhii\Espresso\Expression;

/**
 * A logical OR expression.
 *
 * @since [*next-version*]
 */
class OrExpression extends \Dhii\Espresso\AbstractLogicalExpression
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
        return $left || $right;
    }

}
