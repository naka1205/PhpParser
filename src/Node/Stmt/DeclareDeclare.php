<?php

namespace Naka507\PhpParser\Node\Stmt;

use Naka507\PhpParser\Node;
use Naka507\PhpParser\Node\Stmt;

class DeclareDeclare extends Stmt
{
    /** @var string Key */
    public $key;
    /** @var Node\Expr Value */
    public $value;

    /**
     * Constructs a declare key=>value pair node.
     *
     * @param string    $key        Key
     * @param Node\Expr $value      Value
     * @param array     $attributes Additional attributes
     */
    public function __construct($key, Node\Expr $value, array $attributes = array()) {
        parent::__construct($attributes);
        $this->key = $key;
        $this->value = $value;
    }

    public function getSubNodeNames() {
        return array('key', 'value');
    }
}