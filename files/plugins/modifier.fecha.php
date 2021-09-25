<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty fecha modifier plugin
 *
 * Type:     modifier<br>
 * Name:     fecha<br>
 * Date:     Jul 02, 2021
 * Purpose:  Crear formatos de fecha
 * Input:    Tiempo
 * Example:  {$var|fecha}
 * @link https://www.php.net/manual/es/function.date
 * @author Miguel92
 * @version 1.0
 * @param string
 * @return string
 */
function smarty_modifier_fecha($fecha, $format = false){
   $meses = ['','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];
   $dias = ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'];
   // FORMATO?
   if($format != false){
      // VARS
      $dia     = date("d", $fecha);
      $mes     = date("m", $fecha);
      $mes_int = date("n", $fecha);
      $ano     = date("Y", $fecha);

      // PARSE
      switch($format){
         // 02 de Julio del 2021
         case 'd_Ms_a':
            $e_ano = date("Y", time());
            $ano = ($e_ano == $ano) ? '' : ' del '.$ano;
            $return = $dia.' de '.ucfirst($meses[$mes_int]).$ano;
         break;
         // 02.07.2021
         case 'dma':
            $return = "{$dia}.{$mes}.".date("Y", time());
         break;
         // Julio 02, 2021
         case 'mda':
            $return = ucfirst($meses[$mes_int]). " {$dia}, ".date("Y", time());
         break;
         // 02.07.2021 - 22:16
         case 'dmahs':
            $return = "{$dia}.{$mes}.".date("Y", time())." - ".date("H:i(A)", time());
         break;
      }
      // REGRESAMOS
      return $return;
   } else {
      $ahora = time();
      $tiempo = $ahora - $fecha; 
      $dias = round($tiempo / 86400);
      // HOY
      if($dias <= 0) {
         // HACE MENOS DE 1 HORA
         if(round($tiempo / 3600) <= 0) { 
            // HACE MENOS DE 1 MINUTO
            if(round($tiempo / 60) <= 0) { 
               if($tiempo <= 60) $hace = "Hace unos segundos"; 
               // HACE X MINUTOS 
            } else  { 
               $can = round($tiempo / 60); 
               $word = ($can <= 1) ? "minuto" : "minutos"; 
               $hace = "Hace {$can} {$word}"; 
            }
         // HACE X HORAS
         } else { 
            $can = round($tiempo / 3600); 
            $word = ($can <= 1) ? "hora" : "horas";
            $hace = 'Hace '.$can. " ".$word; 
         }    
      // MENOS DE 7 DIAS
      } else if($dias <= 7){
         // AYER | 5 días
         $hace = ($dias < 2) ? 'Ayer a las '.date("H",$fecha).":".date("i",$fecha) : 'El '.$dias[date("w",$fecha)].' a las '.date("H",$fecha).":".date("i",$fecha);
      // HACE MAS DE UNA SEMANA
      } else{
         $hace = "El ".date("d",$fecha)." de ".$meses[date("n",$fecha)]." a las ".date("H",$fecha).":".date("i",$fecha);
      }
      //
      return $hace;
   }
}