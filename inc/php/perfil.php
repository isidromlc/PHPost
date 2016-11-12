<?php 
/**
 * Controlador
 *
 * @name    perfil.php
 * @author  PHPost Team
*/
/**********************************\

*	(VARIABLES POR DEFAULT)		*

\*********************************/

	$tsPage = "perfil";	// tsPage.tpl -> PLANTILLA PARA MOSTRAR CON ESTE ARCHIVO.

	$tsLevel = 0;		// NIVEL DE ACCESO A ESTA PAGINA. => VER FAQs

	$tsAjax = empty($_GET['ajax']) ? 0 : 1; // LA RESPUESTA SERA AJAX?
	
	$tsContinue = true;	// CONTINUAR EL SCRIPT
	
/*++++++++ = ++++++++*/

	include "../../header.php"; // INCLUIR EL HEADER

	$tsTitle = $tsCore->settings['titulo']; 	// TITULO DE LA PAGINA ACTUAL

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

	$username = $tsCore->setSecure($_GET['user']);
	$usuario = db_exec('fetch_assoc', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT user_id, user_name, user_activo, user_baneado FROM u_miembros WHERE LOWER(user_name) = \''.$tsCore->setSecure($username).'\''));
	// EXISTE?
	if(empty($usuario['user_id']) || ($usuario['user_activo'] != 1 && !$tsUser->permisos['movcud'] && !$tsUser->is_admod) || ($usuario['user_baneado'] != 0 && !$tsUser->permisos['movcus'] && !$tsUser->is_admod)) {
		$tsPage = 'aviso';
		$tsAjax = 0;
		$smarty->assign("tsAviso",array('titulo' => 'Opps!', 'mensaje' => (empty($usuario['user_id']) ? 'El usuario no existe' : 'La cuenta de '.$usuario['user_name'].' se encuentra inhabilitada' ), 'but' => 'Ir a p&aacute;gina principal'));

	} else {
	//
	include("../class/c.cuenta.php");
	$tsCuenta =& tsCuenta::getInstance();

/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/

	
	include('../ext/datos.php');
	$tsInfo = $tsCuenta->loadHeadInfo($usuario['user_id']);
    $tsInfo['uid'] = $usuario['user_id'];
	// IS ONLINE?
    $is_online = (time() - ($tsCore->settings['c_last_active'] * 60));
    $is_inactive = (time() - (($tsCore->settings['c_last_active'] * 60) * 2)); // DOBLE DEL ONLINE
    //
    if($tsInfo['user_lastactive'] > $is_online) $tsInfo['status'] = array('t' => 'Online', 'css' => 'online');
    elseif($tsInfo['user_lastactive'] > $is_inactive) $tsInfo['status'] = array('t' => 'Inactivo', 'css' => 'inactive');
    elseif($tsInfo['user_baneado'] > 0) $tsInfo['status'] = array('t' => 'Suspendido', 'css' => 'banned');
    else $tsInfo['status'] = array('t' => 'Offline', 'css' => 'offline');
	// GENERAL
	$tsGeneral = $tsCuenta->loadGeneral($usuario['user_id']);
    $tsInfo['nick'] = $tsInfo['user_name'];
    $tsInfo = array_merge($tsInfo,$tsGeneral);
    // PAIS
	$tsInfo['user_pais'] = $tsPaises[$tsInfo['user_pais']];
    // LO SIGO?
    $tsInfo['follow'] = $tsCuenta->iFollow($usuario['user_id']);
	// ME SIGUE?
    $tsInfo['yfollow'] = $tsCuenta->yFollow($usuario['user_id']);
    // MANDAR A PLANTILLA
	$smarty->assign("tsInfo",$tsInfo);
	$smarty->assign("tsGeneral",$tsGeneral);
    // MURO
    include("../class/c.muro.php");
    $tsMuro =& tsMuro::getInstance();
    // PERMISOS
    $priv = $tsMuro->getPrivacity($usuario['user_id'], $username, $tsInfo['follow'], $tsInfo['yfollow'] );
    // SE PERMITE VER EL MURO?
    if($priv['m']['v'] == true){
        // CARGAR HISTORIA
        if(!empty($_GET['pid'])) {
            $pub_id = $tsCore->setSecure($_GET['pid']);
            $story = $tsMuro->getStory($pub_id, $usuario['user_id']);
            //
            if(!is_array($story)){
                $tsPage = 'aviso';
                $smarty->assign("tsAviso",array('titulo' => 'Opps...', 'mensaje' => $story, 'but' => 'Ir a pagina principal', 'link' => "{$tsCore->settings['url']}"));
            }
            else {
                $story['data'][1] = $story;
                $smarty->assign("tsMuro", $story);
                $smarty->assign("tsType","story");
            }
        }elseif($tsCore->settings['c_allow_portal'] == 0 && $tsInfo['uid'] == $tsUser->uid){
            $smarty->assign("tsMuro",$tsMuro->getNews());
            $smarty->assign("tsType","news");
        }else{
            $smarty->assign("tsMuro",$tsMuro->getWall($usuario['user_id']));
            $smarty->assign("tsType","wall");
        }
    }
    $smarty->assign("tsPrivacidad",$priv);
	// TITULO
	$tsTitle = 'Perfil de '.$tsInfo['nick'].' - '.$tsTitle;
 
	
/**********************************\

* (AGREGAR DATOS GENERADOS | SMARTY) *

\*********************************/
		}
	}

if(empty($tsAjax)) {	// SI LA PETICION SE HIZO POR AJAX DETENER EL SCRIPT Y NO MOSTRAR PLANTILLA, SI NO ENTONCES MOSTRARLA.

	$smarty->assign("tsTitle",$tsTitle);	// AGREGAR EL TITULO DE LA PAGINA ACTUAL

	/*++++++++ = ++++++++*/
	include("../../footer.php");
	/*++++++++ = ++++++++*/
}