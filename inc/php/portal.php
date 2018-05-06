<?php 
/**
 * Controlador
 *
 * @name    portal.php
 * @author  PHPost Team
*/
/**********************************\

*	(VARIABLES POR DEFAULT)		*

\*********************************/

	$tsPage = "portal";	// tsPage.tpl -> PLANTILLA PARA MOSTRAR CON ESTE ARCHIVO.

	$tsLevel = 0;		// NIVEL DE ACCESO A ESTA PAGINA. => VER FAQs

	$tsAjax = empty($_GET['ajax']) ? 0 : 1; // LA RESPUESTA SERA AJAX?
	
	$tsContinue = true;	// CONTINUAR EL SCRIPT
	
/*++++++++ = ++++++++*/

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
    // PORTAL
    include(TS_CLASS."c.portal.php");
    $tsPortal = new tsPortal();
    // AFILIADOS
    include("inc/class/c.afiliado.php");
    $tsAfiliado = new tsAfiliado();
    // NOS HAN REFERIDO?
    if(!empty($_GET['ref'])) $tsAfiliado->urlIn();

/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/

    $smarty->assign("tsMuro",$tsPortal->getNews());
    $smarty->assign("tsInfo",array('uid' => $tsUser->uid));
    $smarty->assign("tsType", "news");
    //
    $smarty->assign("tsCategories",$tsPortal->composeCategories());
    //$tsPosts = $tsPortal->getMyPosts();
    //$smarty->assign("tsPosts",$tsPosts['data']);
    //$smarty->assign("tsPages",$tsPosts['pages']);
    //
    $smarty->assign("tsLastPostsVisited",$tsPortal->getLastPosts());
    $smarty->assign("tsFavorites",$tsPortal->getFavorites());
    // FOTOS
    $tsImages = $tsPortal->getFotos();
	$smarty->assign("tsImages",$tsImages);
    $smarty->assign("tsImTotal",count($tsImages));
    // STATS
    $smarty->assign("tsStats",$tsPortal->getStats());
    // AFILIADOS
    $smarty->assign("tsAfiliados",$tsAfiliado->getAfiliados());

/**********************************\

* (AGREGAR DATOS GENERADOS | SMARTY) *

\*********************************/
	}

if(empty($tsAjax)) {	// SI LA PETICION SE HIZO POR AJAX DETENER EL SCRIPT Y NO MOSTRAR PLANTILLA, SI NO ENTONCES MOSTRARLA.

	$smarty->assign("tsTitle",$tsTitle);	// AGREGAR EL TITULO DE LA PAGINA ACTUAL

	/*++++++++ = ++++++++*/
	include(TS_ROOT."/footer.php");
	/*++++++++ = ++++++++*/
}