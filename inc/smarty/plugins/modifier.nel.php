<?php

function smarty_modifier_nel($string){
	$a = $string;
	$a = preg_replace("#(<br />)++#", "<br>", $a);
    return $a;
}


?>
