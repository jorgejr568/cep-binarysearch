<?php
/**
 * Created by PhpStorm.
 * User: jorge-jr
 * Date: 22/06/18
 * Time: 00:18
 */

namespace CEPSearcher\Engine\Hash;


class Hash
{
    const BOLSA_HASH                 =   "sha256";
    const BOLSA_HASH_FILE_LIMITER    =   10000;

    /**
     * @param $v
     * @return float|int
     */
    public static function bolsa($v){
        $v=(hash(self::BOLSA_HASH,$v));
        $v_exploded = str_split($v);
        $sum=0;
        foreach ($v_exploded as $item) {
            $sum+=hexdec($item);
        }
        return  $sum % self::BOLSA_HASH_FILE_LIMITER;
    }
}