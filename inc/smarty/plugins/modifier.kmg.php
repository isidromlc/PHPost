<?php
/**
 * Smarty cat modifier plugin
 *
 * Type:     modifier
 * Name:     kmg
 * Date:     Jun 11, 2014
 * Purpose:  Convert 10000 => 1K, 1000000 => 1M
 * Example:  {$number|kmg}
 * @author   Kmario19
 * @version 1.0
 * @param int
 * @return string
 * @return decimal
*/
function smarty_modifier_kmg($number, $decimal = 0){
  $pre = 'KMG';
  if ($number >= 1000) {
    for ($i=-1; $number>=1000; ++$i) { $number /= 1000; }
    return round($number,$decimal).$pre[$i];
  } else return $number;
}