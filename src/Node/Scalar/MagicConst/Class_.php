<?php

namespace Naka507\PhpParser\Node\Scalar\MagicConst;

use Naka507\PhpParser\Node\Scalar\MagicConst;

class Class_ extends MagicConst
{
    public function getName() {
        return '__CLASS__';
    }
}