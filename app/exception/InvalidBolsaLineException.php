<?php
/**
 * Created by PhpStorm.
 * User: jorge-jr
 * Date: 16/06/18
 * Time: 14:28
 */

namespace CEPSearcher\Exception;


use Exception;
use Throwable;

class InvalidBolsaLineException extends Exception
{

    /**
     * InvalidBolsaLineException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "INVALID BOLSA LINE!", $code = 401, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}