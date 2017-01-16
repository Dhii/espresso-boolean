<?php

namespace Dhii\Espresso;

use Dhii\Evaluable\EvaluableInterface;

/**
 * An abstract logical expression implementation that exposes public methods for term
 * management, similar to {@see Dhii\Espresso\AbstractGenericExpression}.
 *
 * @since [*next-version*]
 */
abstract class AbstractGenericLogicalExpression extends AbstractLogicalExpression
{
    /**
     * Constructor.
     *
     * @since [*next-version*]
     *
     * @param array $terms   [optional] An array of evaluable terms. Default: array()
     * @param bool  $negated [optional] True to negate the expression, false otherwise.
     */
    public function init(array $terms = array(), $negated = false)
    {
        $this->_setTerms($terms)
            ->_setNegated($negated);

        return $this;
    }

    /*
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
        $this->_setNegated($negated);

        return $this;
    }

    /**
     * Adds a term to the expression.
     *
     * @since [*next-version*]
     *
     * @param EvaluableInterface $term The term instance.
     *
     * @return $this This instance.
     */
    public function addTerm(EvaluableInterface $term)
    {
        return $this->_addTerm($term);
    }

    /**
     * Removes the term at a specific index from the expression.
     *
     * @since [*next-version*]
     *
     * @param int $index The zero-based index of the term to remove.
     *
     * @return $this This instance.
     */
    public function removeTerm($index)
    {
        return $this->_removeTerm($index);
    }

    /**
     * Gets a term at a specific index from the expression.
     *
     * @since [*next-version*]
     *
     * @param int $index The zero-based index of the term to retrieve.
     *
     * @return EvaluableInterface The term at the given index or null if the index is invalid.
     */
    public function getTerm($index)
    {
        return $this->_getTerm($index);
    }

    /**
     * Sets the expression terms.
     *
     * @since [*next-version*]
     *
     * @param array $terms An array of EvaluableInterface instances.
     *
     * @return $this This instance.
     */
    public function setTerms(array $terms)
    {
        return $this->_setTerms($terms);
    }
}