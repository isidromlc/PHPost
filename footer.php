<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * El footer permite mostrar la plantilla
 *
 * @name    footer.php
 * @author  PHPost Team
 */

/*
 * -------------------------------------------------------------------
 *  Realizamos tareas para mostrar la plantilla
 * -------------------------------------------------------------------
 */
    // Página solicitada
    $smarty->assign("tsPage",$tsPage);

    // 
    $smarty_next = false;
    
    // Verificamos si la plantilla existe 
    // Si no existe mostramos la que está en default
    if(!$smarty->template_exists("t.$tsPage.tpl")){
    	$smarty->template_dir = TS_ROOT.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.'templates';
    	if($smarty->template_exists("t.$tsPage.tpl")) $smarty_next = true;
    } else $smarty_next = true;
    
    // Mostramos la plantilla
    if($smarty_next == true) $smarty->display("t.$tsPage.tpl");
    else die("0: Lo sentimos, se produjo un error al cargar la plantilla 't.$tsPage.tpl'. Contacte al administrador");