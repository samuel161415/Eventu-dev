<?php

namespace App\Exceptions;

use Exception;

class BusinessOwnershipException extends Exception
{
    public function __construct($message = "Default message", $code = 0, Exception $previous = null)
    {
        $code = $code ?: 422; 
        parent::__construct($message, $code, $previous);
    }

    public function render($request)
    {
        return response()->json(['message' => $this->getMessage()], $this->getCode());
    }
}
