<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty cat modifier plugin
 *
 * Type:     modifier
 * Name:     seo
 * Date:     Oct 14, 2010
 * Purpose:  catenate a value to a variable
 * Input:    string to catenate
 * Example:  {$var|seo}
 * @link http://smarty.php.net/manual/en/language.modifier.cat.php cat
 *          (Smarty online manual)
 * @author   Ivan Molina Pavana
 * @version 1.0
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_seo($string){
	// ESPAÑOL
	$espanol = array('á','é','í','ó','ú','ñ');
	$ingles = array('a','e','i','o','u','n');
	// MINUS
	$string = str_replace($espanol,$ingles,$string);
	$string = trim($string);
	$string = trim(preg_replace("/[^ A-Za-z0-9_]/", "-", $string));
	$string = preg_replace("/[ \t\n\r]+/", "-", $string);
	$string = str_replace(" ", "-", $string);
	$string = preg_replace("/[ -]+/", "-", $string);
	//
	return $string;
}

/* vim: set expandtab: */

?>
