<?php
/**
 * Smarty nobbcode modifier plugin
 *
 * Tipo:			modifier
 * Nombre:     nobbcode
 * Fecha:		MMM 000, 0000
 * Proposito:  Quita las etiquetas de los bbcodes [b], [i], etc
 * Ejemplo:  	{$string|nobbcode}
 * @author   	AAAAAA
 * @version 	1.0
 * @param 		nobbcode
 * @return 		nobbcode
*/
function smarty_modifier_nobbcode($nobbcode = ''){
  $nobbcode = preg_replace('/\[([^\]]*)\]/', '', $nobbcode); 
  $regex = "@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@";
  $nobbcode = preg_replace($regex, ' ', $nobbcode);
  return $nobbcode;
}