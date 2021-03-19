<?php
/**
 * Smarty nohtmltrim modifier plugin
 *
 * Tipo:			modifier
 * Nombre:     nohtmltrim
 * Fecha:		Nov 11, 2019
 * Proposito:  Quita las etiquetas html y los espacios que se encuentren a la derecho o izquierda
 * Ejemplo:  	{$string|nohtmltrim}
 * @author   	Miguel92
 * @version 	1.0
 * @param 		string
 * @return 		string
*/
function smarty_modifier_NoHtmlTrim($string) {
  $str = trim($string);
  $str = strip_tags($string);
  return $str;
}