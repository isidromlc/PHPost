<?php
function smarty_modifier_limit($string, $length = 80) {
    if ($length == 0) return '';
    if (strlen($string) > $length) {
		$text = substr($string, 0, $length);
		$text = $text.'...';
		return $text;
    } else {
        return $string;
    }
}
?>
