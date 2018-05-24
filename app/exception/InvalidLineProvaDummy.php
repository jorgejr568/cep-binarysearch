<?php

namespace CEPSearcher\Exception;


use Throwable;

class InvalidLineProvaDummy extends \Exception
{
    public function __construct($message = "INVALID PROVA DUMMY LINE!", $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}