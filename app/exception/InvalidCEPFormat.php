<?php
/**
 * Created by PhpStorm.
 * User: jorgejr568
 * Date: 24/03/18
 * Time: 17:11
 */

namespace CEPSearcher\Exception;


use Throwable;

class InvalidCEPFormat extends \Exception
{
    public function __construct($message = "INVALID CEP INFORMED!", $code = 401, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
