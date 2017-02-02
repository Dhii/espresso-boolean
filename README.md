# Espresso - Logical Expressions

[![Build Status](https://travis-ci.org/Dhii/espresso-logical.svg?branch=master)](https://travis-ci.org/Dhii/espresso-logical)

A package for [Espresso][] that adds logical expressions for representing and evaluating logical expressions such as
`AND`, `OR`, `XOR`, et al.

## Requirements

**PHP** >=5.3.9

## Installation

```
composer require dhii/espresso-logical
```

The packages adheres to the SemVer specification, and there will be full backward compatibility between minor versions.

Additionally, it follows the rule of the [caret operator][], i.e. there will be full backward compatibility between
patch pre-release versions.

## Usage

The following is an example that demonstrates usage of the `AndExpression` class.

```php
$expr = new Expression\AndExpression(array(
    new Term\VariableTerm('x'),
    new Term\VariableTerm('y')
));

$ctx = new Context\CompositeContext(array(
    'x' => true,
    'y' => false
));

$expr->evaluate($ctx); // false

$expr->setNegated(true);
$expr->evaluate($ctx); // true
```

[Espresso]:         https://github.com/Dhii/espresso
[caret operator]:   https://getcomposer.org/doc/articles/versions.md#caret