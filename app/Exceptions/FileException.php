<?php

namespace App\Exceptions;

use Throwable;

class FileException extends FMSException
{
    public function __construct($message = "File handling exception", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [FMS]: {$this->message}\n";
    }
}
