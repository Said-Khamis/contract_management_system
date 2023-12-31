<?php

namespace App\Exceptions;

use Exception;

class FMSException  extends Exception
{
    private Exception $previous;

    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code);

        if (!is_null($previous))
        {
            $this -> previous = $previous;
        }
    }
}
{

}
