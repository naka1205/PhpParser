<?php

namespace Naka507\PhpParser\Node\Stmt;

use Naka507\PhpParser\Node;
use Naka507\PhpParser\Node\Stmt;

abstract class TraitUseAdaptation extends Stmt
{
    /** @var Node\Name Trait name */
    public $trait;
    /** @var string Method name */
    public $method;
}
