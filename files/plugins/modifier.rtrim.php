<?php
/**
 * Smarty modifier plugin
 *
 * Type:     	modifier
 * Name:     	rtrim
 * Date:     	Feb 11, 2022
 * Purpose:  	Eliminamos ultimo caracter de un string
 * Example:  	{$string|rtrim}
 * @author		Miguel
 * @version 	1.0
 * @param 		string
 * @return 		string
*/
function smarty_modifier_rtrim(string $string = ''){
	return substr($string, 0, -1);
}