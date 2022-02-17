<?php

function smarty_modifier_getUrl($text){
	$return = str_replace(' ','_',$text);
	$return = str_replace(array('?','¿','¡','!','%'),'',$return);
	return $return;
}
