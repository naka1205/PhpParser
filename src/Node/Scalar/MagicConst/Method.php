<?php

namespace Naka507\PhpParser\Node\Scalar\MagicConst;

use Naka507\PhpParser\Node\Scalar\MagicConst;

class Method extends MagicConst
{
    public function getName() {
        return '__METHOD__';
    }
}