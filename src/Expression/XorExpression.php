<?php

namespace Dhii\Espresso\Expression;

use Dhii\Data\ValueAwareInterface;
use Dhii\Espresso\AbstractGenericLogicalExpression;

/**
 * A logical XOR expression.
 *
 * @since [*next-version*]
 */
class XorExpression extends AbstractGenericLogicalExpression
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
        $this->_init($terms, $negated);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _operator($left, $right, ValueAwareInterface $ctx = null)
    {
        return $left xor $right;
    }
}
