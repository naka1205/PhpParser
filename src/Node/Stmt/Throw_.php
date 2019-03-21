<?php

namespace Naka507\PhpParser\Node\Stmt;

use Naka507\PhpParser\Node;
use Naka507\PhpParser\Node\Stmt;

class Throw_ extends Stmt
{
    /** @var Node\Expr Expression */
    public $expr;

    /**
     * Constructs a throw node.
     *
     * @param Node\Expr $expr       Expression
     * @param array     $attributes Additional attributes
     */
    public function __construct(Node\Expr $expr, array $attributes = array()) {
        parent::__construct($attributes);
        $this->expr = $expr;
    }

    public function getSubNodeNames() {
        return array('expr');
    }
}
