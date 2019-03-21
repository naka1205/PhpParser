<?php

namespace Naka507\PhpParser\Node\Expr;

use Naka507\PhpParser\Node\Expr;

abstract class Cast extends Expr
{
    /** @var Expr Expression */
    public $expr;

    /**
     * Constructs a cast node.
     *
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Expr $expr, array $attributes = array()) {
        parent::__construct($attributes);
        $this->expr = $expr;
    }

    public function getSubNodeNames() {
        return array('expr');
    }
}
