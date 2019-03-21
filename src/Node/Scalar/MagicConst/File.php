<?php

namespace Naka507\PhpParser\Node\Scalar\MagicConst;

use Naka507\PhpParser\Node\Scalar\MagicConst;

class File extends MagicConst
{
    public function getName() {
        return '__FILE__';
    }
}