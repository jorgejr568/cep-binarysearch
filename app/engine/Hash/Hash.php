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
    const BOLSA_HASH                 =   "crc32b";
    const BOLSA_HASH_FILE_LIMITER    =   92000;

    /**
     * @param $v
     * @return float|int
     */
    public static function bolsa($v){
        $v=(hash(self::BOLSA_HASH,$v));
        $v_exploded = str_split($v);
        $sum=1;
        foreach ($v_exploded as $item) {
            $ix=hexdec($item);
            $sum+=($sum*($ix!=0?$ix:1));
        }
        return  $sum % self::BOLSA_HASH_FILE_LIMITER;
    }
}