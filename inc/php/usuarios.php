<?php 
/**
 * Controlador
 *
 * @name    usuarios.php
 * @author  PHPost Team
*/
/**********************************\

*	(VARIABLES POR DEFAULT)		*

\*********************************/

	$tsPage = "usuarios";	// tsPage.tpl -> PLANTILLA PARA MOSTRAR CON ESTE ARCHIVO.

	$tsLevel = 0;		// NIVEL DE ACCESO A ESTA PAGINA. => VER FAQs

	$tsAjax = empty($_GET['ajax']) ? 0 : 1; // LA RESPUESTA SERA AJAX?
	
	$tsContinue = true;	// CONTINUAR EL SCRIPT
	
/*++++++++ = ++++++++*/

	include "../../header.php"; // INCLUIR EL HEADER

	$tsTitle = $tsCore->settings['titulo'].' - '.$tsCore->settings['slogan']; 	// TITULO DE LA PAGINA ACTUAL

/*++++++++ = ++++++++*/

	// VERIFICAMOS EL NIVEL DE ACCSESO ANTES CONFIGURADO
	$tsLevelMsg = $tsCore->setLevel($tsLevel, true);
	if($tsLevelMsg != 1){	
		$tsPage = 'aviso';
		$tsAjax = 0;
		$smarty->assign("tsAviso",$tsLevelMsg);
		//
		$tsContinue = false;
	}
	//
	if($tsContinue){

/**********************************\

* (VARIABLES LOCALES ESTE ARCHIVO)	*

\*********************************/



/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/
    // PAICES
    include("../ext/datos.php");
    $smarty->assign("tsPaises",$tsPaises);
    // USUARIOS
    $tsUsers = $tsUser->getUsuarios();
    $smarty->assign("tsUsers",$tsUsers['data']);
    $smarty->assign("tsPages",$tsUsers['pages']);
    $smarty->assign("tsTotal",$tsUsers['total']);
    // FILTROS
    $smarty->assign("tsFiltro",array('online' => $_GET['online'], 'avatar' => $_GET['avatar'], 'sex' => $_GET['sexo'], 'pais' => $_GET['pais'], 'rango' => $_GET['rango']));
    // RANGOS
	$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT rango_id, r_name FROM u_rangos ORDER BY rango_id');
    $smarty->assign("tsRangos",result_array($query));
    

/**********************************\

* (AGREGAR DATOS GENERADOS | SMARTY) *

\*********************************/
	}

if(empty($tsAjax)) {	// SI LA PETICION SE HIZO POR AJAX DETENER EL SCRIPT Y NO MOSTRAR PLANTILLA, SI NO ENTONCES MOSTRARLA.

	$smarty->assign("tsTitle",$tsTitle);	// AGREGAR EL TITULO DE LA PAGINA ACTUAL

	/*++++++++ = ++++++++*/
	include("../../footer.php");
	/*++++++++ = ++++++++*/
}