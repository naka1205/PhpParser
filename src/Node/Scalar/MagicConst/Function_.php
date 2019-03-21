<?php

namespace Naka507\PhpParser\Node\Scalar\MagicConst;

use Naka507\PhpParser\Node\Scalar\MagicConst;

class Function_ extends MagicConst
{
    public function getName() {
        return '__FUNCTION__';
    }
}