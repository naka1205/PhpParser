<?php

namespace Naka507\PhpParser\Node\Stmt;

use Naka507\PhpParser\Node;
use Naka507\PhpParser\Node\Stmt;

class Switch_ extends Stmt
{
    /** @var Node\Expr Condition */
    public $cond;
    /** @var Case_[] Case list */
    public $cases;

    /**
     * Constructs a case node.
     *
     * @param Node\Expr $cond       Condition
     * @param Case_[]   $cases      Case list
     * @param array     $attributes Additional attributes
     */
    public function __construct(Node\Expr $cond, array $cases, array $attributes = array()) {
        parent::__construct($attributes);
        $this->cond = $cond;
        $this->cases = $cases;
    }

    public function getSubNodeNames() {
        return array('cond', 'cases');
    }
}
