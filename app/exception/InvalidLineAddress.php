<?php
/**
 * Created by PhpStorm.
 * User: jorgejr568
 * Date: 22/03/18
 * Time: 17:53
 */

namespace CEPSearcher\Exception;


use Throwable;

class InvalidLineAddress extends \Exception
{
    public function __construct($message = "INVALID ADDRESS LINE!", $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}