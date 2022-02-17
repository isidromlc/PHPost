<?php
/**
 * ACCESO Login & Registro
 * -------------------------------------------------------------
 * File:     acceso.php
 * Name:     acceso
 * Purpose:  Control del login y registro
 * @link:    https://phpost.net/foro/
 * @author:  Miguel92
 * @version: 1.0
 * -------------------------------------------------------------
*/

/**
 * Nombre asignado para el archivo .tpl
*/
$tsPage = "acceso";

/**
 * Nivel de acceso a esta página
 * 0 - todos | 1 - visitantes | 2 - miembros | 3 - moderadores | 4 - administradores
*/
$tsLevel = 1; 

/**
 * Tipo de respuesta
*/
$tsAjax = empty($_GET['ajax']) ? 0 : 1;

/**
 * En caso de problemas la variable cambia
*/
$tsContinue = true;  // CONTINUAR EL SCRIPT
   
/**
 * Incluimos el título a la página
*/
$tsTitle = "Bienvenidos a {$tsCore->settings['titulo']}";

/**
 * Verificamos el nivel de acceso
*/
$tsLevelMsg = $tsCore->setLevel($tsLevel, true);
if ($tsLevelMsg != 1) {
   $tsPage = 'aviso';
   $tsAjax = 0;
   $smarty->assign("tsAviso", $tsLevelMsg);
   $tsContinue = false;
}

/**
 * Si no hay problemas, continuamos
*/
if ($tsContinue) {
	
	$javascript = "www.google.com/recaptcha/api.js?render=" . $tsCore->settings["pkey"];

   $smarty->assign([
      "javascript" => $javascript,
      "public_key" => $tsCore->settings["pkey"],
      "tsAbierto" => $tsCore->settings["c_reg_active"]
   ]);
   
}


if(empty($tsAjax)) {	
	$smarty->assign("tsTitle", $tsTitle);	// AGREGAR EL TITULO DE LA PAGINA ACTUAL
	
	/*++++++++ = ++++++++*/
	include(TS_ROOT . "/footer.php");
	/*++++++++ = ++++++++*/
}