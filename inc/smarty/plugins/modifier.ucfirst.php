<?php 
/**
 * Smarty ucfirst modifier plugin
 *
 * Tipo:			modifier
 * Nombre:     ucfirst
 * Fecha:		MMM 000, 0000
 * Proposito:  Convierte todas las primeras letras de la palabra en mayúscula
 * Ejemplo:  	{$string|ucfirst}
 * @author   	Miguel92
 * @version 	1.0
 * @param 		string
 * @return 		string
*/
function smarty_modifier_ucfirst($string) {
  return ucfirst($string);
}