<?php

namespace Naka507\PhpParser\Node\Stmt;

use Naka507\PhpParser\Node;
use Naka507\PhpParser\Node\Stmt;

class Global_ extends Stmt
{
    /** @var Node\Expr[] Variables */
    public $vars;

    /**
     * Constructs a global variables list node.
     *
     * @param Node\Expr[] $vars       Variables to unset
     * @param array       $attributes Additional attributes
     */
    public function __construct(array $vars, array $attributes = array()) {
        parent::__construct($attributes);
        $this->vars = $vars;
    }

    public function getSubNodeNames() {
        return array('vars');
    }
}
