<?php
/**
 * Type:     modifier
 * Name:     strlen
 * Date:     En 07, 2021
 * Purpose:  Contar caracteres
 * Example:  {$string|strlen}
 * @author   Miguel92
 * @version 1.0
 * @param int
 * @return string
 * @return int
*/
function smarty_modifier_strlen($string){
  return strlen($string);
}