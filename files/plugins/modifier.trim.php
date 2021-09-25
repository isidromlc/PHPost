<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty trim modifier plugin
 *
 * Type:     modifier<br>
 * Name:     trim<br>
 * Purpose:  eliminar los espacios de derecha e izquiera
 * @link http://smarty.php.net/manual/en/language.modifier.trim.php
 *          trim (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @return string
 */
function smarty_modifier_trim($string) {
   return trim($string);
}