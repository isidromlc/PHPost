<?php
/**
 * @author Bits4me(phpost)
 * @return string
 */
function smarty_modifier_extrae($string,$s = 0){
	if ($s == 1) {
        preg_match('/(<img[^>]+>)/i', $string, $imgs);
        preg_match( '/data-original="(.+?)"/', $imgs[0], $img);

        if(empty($imgs[0])) $img = "";
        //
        return $img[1];
	}else{
		$patterns = array();
	    $patterns[0] = '/\[(.+?)\](.*?)\[\/(.+?)\]/';
	    $patterns[1] = '/<.+?>/i';
	    $patterns[2] = "/[\r\n]/";
	    $patterns[3] = '/( ){2,}/';
		$texto = preg_replace( $patterns, ' ', $string);

	   	return $texto;
	}
}
 
?>