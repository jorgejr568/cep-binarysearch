<?php
/**
 * Created by PhpStorm.
 * User: jorge-jr
 * Date: 16/06/18
 * Time: 16:42
 */

namespace CEPSearcher\Engine\Sort;


class Sort
{
    public function quick_sort($array,$comparable)
    {
        // find array size
        $length = count($array);

        // base case test, if array of length 0 then just return array to caller
        if($length <= 1){
            return $array;
        }
        else{

            // select an item to act as our pivot point, since list is unsorted first position is easiest
            $pivot = $array[0];

            // declare our two arrays to act as partitions
            $left = $right = array();

            // loop and compare each item in the array to the pivot value, place item in appropriate partition
            for($i = 1; $i < count($array); $i++)
            {
                if($comparable($array[$i],$pivot)){
                    $left[] = $array[$i];
                }
                else{
                    $right[] = $array[$i];
                }
            }

            // use recursion to now sort the left and right lists
            echo $pivot->getHash().PHP_EOL;
            return array_merge($this->quick_sort($left,$comparable), array($pivot), $this->quick_sort($right,$comparable));
        }
    }

}