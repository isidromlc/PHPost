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
 * Name:     hace<br>
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
function smarty_modifier_hace($fecha, $show = false){
     
    $ahora = time();
    $tiempo = $ahora - $fecha; 
    //
    $dias = round($tiempo / 86400);
    // HOY
    if($dias <= 0) {
        // HACE MENOS DE 1 HORA
        if(round($tiempo / 3600) <= 0){ 
            // HACE MENOS DE 1 MINUTO
            if(round($tiempo / 60) <= 0){ 
                if($tiempo <= 60){ $hace = "Hace unos segundos"; }
            // HACE X MINUTOS 
            } else  { 
            	$can = round($tiempo / 60); 
            	if($can <= 1) {    $word = "minuto"; } else { $word = "minutos"; } 
            	$hace = 'Hace '.$can. " ".$word; 
            }
        // HACE X HORAS
        } else { 
            $can = round($tiempo / 3600); 
            if($can <= 1) {    $word = "hora"; } else {    $word = "horas"; } 
            $hace = 'Hace '.$can. " ".$word; 
        }    
    }
    // MENOS DE 7 DIAS
    else if($dias <= 30){
        // AYER
        if($dias < 2){
            $hace = 'Ayer';
        // HACE MENOS DE 5 DIAS
        } else {
            $hace = 'Hace '.$dias.' d&iacute;as';
        }
    // HACE MAS DE UNA SEMANA
    } else{
        $meses = round($tiempo / 2592000);
        if($meses == 1) $hace = 'M&aacute;s de 1 mes';
        elseif($meses < 12) {
            $hace = 'M&aacute;s de '.$meses.' meses';
        } else {
            $anos = round($tiempo / 31536000);
            if($anos == 1) $hace = 'M&aacute;s de un a&ntilde;o';
            else $hace = 'M&aacute;s de '.$anos.' a&ntilde;os';
        }
    }
    //
    return $hace;

}

/* vim: set expandtab: */

?>
