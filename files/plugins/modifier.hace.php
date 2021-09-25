<?php
/**
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     modifier.hace.php
 * Type:     modifier
 * Name:     hace
 * Purpose:  Convierte fecha en timeago (hace tiempo)
 * -------------------------------------------------------------
 * @link https://css-tricks.com/snippets/php/time-ago-function/
 * @author Chris Coyier 
 * @author Miguel92
 * @version 1.0
 * @param string
 * @return string
 */
function smarty_modifier_hace($tiempo){
 
   $periodos = ["segundo", "minuto", "hora", "dia", "semana", "mes", "año", "decada"];
   $lengths = ["60","60","24","7","4.35","12","10"];

   $ahora = time();
   $diferencia = $ahora - $tiempo;

   for($j = 0; $diferencia >= $lengths[$j] && $j < count($lengths)-1; $j++) {
      $diferencia /= $lengths[$j];
   }

   # redoneamos
   $diferencia = round($diferencia);

   if($diferencia != 1) {
      # Hacemos esta pregunta "$j es igual a 5", por que sería así $periodos["mes"]
      $periodos[$j] .= ($j == 5) ? "es" : "s";
   }

   return ($diferencia == 0) ? "Hace unos segundos " : "Hace $diferencia $periodos[$j] ";
}