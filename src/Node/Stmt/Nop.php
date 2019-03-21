<?php

namespace Naka507\PhpParser\Node\Stmt;

use Naka507\PhpParser\Node;
use Naka507\PhpParser\Node\Stmt;

/** Nop/empty statement (;). */
class Nop extends Stmt
{
    public function getSubNodeNames() {
        return array();
    }
}
