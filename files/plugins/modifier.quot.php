<?php
/**
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     modifier.quote.php
 * Type:     modifier
 * Name:     quote
 * Purpose:  pequeño hack
 * -------------------------------------------------------------
 * @author PHPost
 * @version 1.0
 * @param string
 * @return string
*/

function smarty_modifier_quot($string){
   // MINI HACK
   $string = str_replace(
    	["&amp;","&#039;"], 
    	['&', "'"], 
    	$string
   );
   $string = nl2br($string);
   //
   return $string;
}