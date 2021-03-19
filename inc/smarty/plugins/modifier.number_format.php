<?php
function smarty_modifier_number_format($string, $decimals = 0, $dec_sep=",", $thous_sep = ".") { 
  return number_format($string,$decimals,$dec_sep,$thous_sep);
}