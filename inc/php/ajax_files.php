<?php

/**
 * Ajax File :: Configuración de archivos ajax
 *
 * @package Smarty 3.1.39
 * @author PHPost Team & Miguel92 
 * @copyright NewRisus 2021
 * @version v1.0 23-02-2021
 * @link https://newrisus.com
*/

/**********************************\

*	(VARIABLES POR DEFAULT)		*

\*********************************/

	$tsPage = "";	// tsPage.tpl -> PLANTILLA PARA MOSTRAR CON ESTE ARCHIVO.

	$tsLevel = 0;		// NIVEL DE ACCESO A ESTA PAGINA. => VER FAQs

	$tsAjax = empty($_GET['ajax']) ? 0 : 1; // LA RESPUESTA SERA AJAX?
	
	include "../../header.php"; // INCLUIR EL HEADER

	$tsTitle = $tsCore->settings['titulo'].' - '.$tsCore->settings['slogan']; 	// TITULO DE LA PAGINA ACTUAL

/**********************************\

* (VARIABLES LOCALES ESTE ARCHIVO)	*

\*********************************/

	$action = htmlspecialchars($_GET['action']);
	$action_type = explode('-',$action);
	$action_type = $action_type[0];

/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/

	// QUE ARCHIVO NECESITAMOS?
	$file = "./ajax/ajax.{$action_type}.php";
	//
	if(file_exists($file)) include($file);
	else die("0: No se encontro el archivo que se ha solicitado.");
	
/**********************************\

* (AGREGAR DATOS GENERADOS | SMARTY) *

\*********************************/

# SI LA PETICION SE HIZO POR AJAX DETENER EL SCRIPT Y NO MOSTRAR PLANTILLA, SI NO ENTONCES MOSTRARLA.
if(empty($tsAjax)) {
	# AGREGAR EL TITULO DE LA PAGINA ACTUAL
	$smarty->assign("tsTitle",$tsTitle);
	include("../../footer.php");
}