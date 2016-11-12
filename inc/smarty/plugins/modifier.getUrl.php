<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty cat modifier plugin
 *
 * Type:     modifier<br>
 * Name:     fecha<br>
 * Date:     Feb 24, 2010
 * Purpose:  catenate a value to a variable
 * Input:    string to catenate
 * Example:  {$var|cat:"foo"}
 * @link http://smarty.php.net/manual/en/language.modifier.cat.php cat
 *          (Smarty online manual)
 * @author   Ivan Molina Pavana
 * @version 1.0
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_getUrl($text){
	// REEMPLAZANDO ' ' => '_'
	$return = str_replace(' ','_',$text);
	// REEMPLAZANDO RAROS
	$return = str_replace(array('?','¿','¡','!','%'),'',$return);
	//
	return $return;
}

/* vim: set expandtab: */

?>
