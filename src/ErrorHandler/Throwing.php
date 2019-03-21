<?php

namespace Naka507\PhpParser\ErrorHandler;

use Naka507\PhpParser\Error;
use Naka507\PhpParser\ErrorHandler;

/**
 * Error handler that handles all errors by throwing them.
 *
 * This is the default strategy used by all components.
 */
class Throwing implements ErrorHandler
{
    public function handleError(Error $error) {
        throw $error;
    }
}