<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Footer :: El footer permite mostrar la plantilla
 *
 * @package Smarty 3.1.39
 * @author PHPost Team & Miguel92 
 * @copyright PHPost Risus 2021
 * @version v1.0 19-03-2021
 * @link https://phpost.net/foro/
*/


# Página solicitada
$smarty->assign("tsPage",$tsPage);

$display = ($tsPage == 'registro' || $tsPage == 'login' || $tsPage == 'aviso') ? "{$tsPage}.tpl"  : "t.{$tsPage}.tpl";
$display = ($smarty->templateExists($display)) ? $display : 'empty.tpl';
// Mostramos la plantilla
$smarty->display($display);