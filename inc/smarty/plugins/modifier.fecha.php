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
 * Example:  {$var|fecha}
 * @link http://smarty.php.net/manual/en/language.modifier.cat.php cat
 *          (Smarty online manual)
 * @author   Ivan Molina Pavana
 * @version 1.0
 * @param string
 * @return string
 */
function smarty_modifier_fecha($fecha, $format = false){
    $_meces = array('','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
    $_dias = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
    // FORMATO?
    if($format != false){
        // VARS
        $dia = date("d",$fecha);
        $mes = date("m",$fecha);
        $mes_int = date("n",$fecha);
        $ano = date("Y",$fecha);
        // PARSE
        switch($format){
            // 29 de Septiembre de 2010
            case 'd_Ms_a':
                $e_ano = date("Y",time());
                $ano = ($e_ano == $ano) ? '' : ' de '.$ano;
                $return = $dia.' de '.$_meces[$mes_int].$ano;
            break;
        }
        // REGRESAMOS
        return $return;
    } else {
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
        else if($dias <= 7){
            // AYER
            if($dias < 2){
                $hace = 'Ayer a las '.date("H",$fecha).":".date("i",$fecha);
            // HACE MENOS DE 5 DIAS
            } else {
                $hace = 'El '.$_dias[date("w",$fecha)].' a las '.date("H",$fecha).":".date("i",$fecha);
            }
        // HACE MAS DE UNA SEMANA
        } else{
            $hace = "El ".date("d",$fecha)." de ".$_meces[date("n",$fecha)]." a las ".date("H",$fecha).":".date("i",$fecha);
        }
        //
        return $hace;
    }
}

/* vim: set expandtab: */

?>
