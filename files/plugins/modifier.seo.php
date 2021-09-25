<?php
/**
 * Smarty plugin
 *
 * Smarty cat modifier plugin
 *
 * @package Smarty
 * @subpackage plugins
 * Type:     modifier
 * Name:     seo
 * Date:     Jul 26, 2021
 * Purpose:  Convierte carecteres acentuados en letras minusculas y simbolos en -
 * Input:    Cadena de texto
 * Example:  {$texto|seo}
 * @link https://stackoverflow.com/a/9535967/13226622 En el que me base
 * @author  desertnaut https://stackoverflow.com/users/4685471/desertnaut
 * @author  Miguel92
 * @version 1.2
 * @param string
 * @return string
 */
function smarty_modifier_seo($string){
	$string = htmlentities($string, ENT_QUOTES, 'UTF-8');
	$string = preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', $string);
	$string = html_entity_decode($string, ENT_QUOTES, 'UTF-8');
	$string = preg_replace('~[^0-9a-z]+~i', '-', $string);
	$string = strtolower(trim($string, '-'));
	return $string;
}

/* vim: set expandtab: */