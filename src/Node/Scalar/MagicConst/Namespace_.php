<?php

namespace Naka507\PhpParser\Node\Scalar\MagicConst;

use Naka507\PhpParser\Node\Scalar\MagicConst;

class Namespace_ extends MagicConst
{
    public function getName() {
        return '__NAMESPACE__';
    }
}