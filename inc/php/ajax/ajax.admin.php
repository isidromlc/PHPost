<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Controlador AJAX
 *
 * @name    ajax.admin.php
 * @author  PHPost Team
*/
/**********************************\

*	(VARIABLES POR DEFAULT)		*

\*********************************/

	// NIVELES DE ACCESO Y PLANTILLAS DE CADA ACCIÓN
	$files = array(
		'admin-medalla-borrar' => array('n' => 4, 'p' => ''),
		'admin-medalla-asignar' => array('n' => 4, 'p' => ''),
		'admin-foto-borrar' => array('n' => 4, 'p' => ''),
		'admin-foto-setOpenClosed' => array('n' => 4, 'p' => ''),
		'admin-foto-setShowHide' => array('n' => 4, 'p' => ''),
		'admin-medallas-borrar-asignacion' => array('n' => 4, 'p' => ''),
		'admin-users-setInActivo' => array('n' => 4, 'p' => ''),
		'admin-users-sessions' => array('n' => 4, 'p' => ''),
		'admin-noticias-setInActive' => array('n' => 4, 'p' => ''),
		'admin-sesiones-borrar' => array('n' => 4, 'p' => ''),
		'admin-nicks-change' => array('n' => 4, 'p' => ''),
        'admin-blacklist-delete' => array('n' => 4, 'p' => ''),
        'admin-badwords-delete' => array('n' => 4, 'p' => ''),
		
	);

/**********************************\

* (VARIABLES LOCALES ESTE ARCHIVO)	*

\*********************************/

	// REDEFINIR VARIABLES
	$tsPage = 'php_files/p.admin.'.$files[$action]['p'];
	$tsLevel = $files[$action]['n'];
	$tsAjax = empty($files[$action]['p']) ? 1 : 0;

/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/
	
	// DEPENDE EL NIVEL
	$tsLevelMsg = $tsCore->setLevel($tsLevel, true);
	if($tsLevelMsg != 1) { echo '0: '.$tsLevelMsg['mensaje']; die();}
    // CLASES
    include("../class/c.medals.php");
    $tsMedal = new tsMedal();
	include("../class/c.admin.php");
    $tsAdmin = new tsAdmin();
    //
	// CODIGO
	switch($action){
		case 'admin-medalla-borrar':
			//<---
            echo $tsMedal->DelMedalla();
			//--->
		break;
		case 'admin-medalla-asignar':
			//<---
            echo $tsMedal->AsignarMedalla();
			//--->
		break;
		case 'admin-medallas-borrar-asignacion':
			//<---
            echo $tsMedal->delAssign();
			//--->
		break;
		case 'admin-foto-borrar':
			//<---
            echo $tsAdmin->DelFoto();
			//--->
		break;
		case 'admin-foto-setOpenClosed':
			//<---
            echo $tsAdmin->setOpenClosedFoto();
			//--->
		break;
		case 'admin-foto-setShowHide':
			//<---
            echo $tsAdmin->setShowHideFoto();
			//--->
		break;
		case 'admin-users-InActivo':
			//<---
            echo $tsAdmin->setUserInActivo();
			//--->
		break;
		case 'admin-users-sessions':
			//<---
            echo $tsAdmin->delSession();
			//--->
		break;
		case 'admin-noticias-setInActive':
			//<---
            echo $tsAdmin->setNoticiaInActive();
			//--->
		break;
		case 'admin-sesiones-borrar':
			//<---
            echo $tsAdmin->delSession();
			//--->
		break;
		case 'admin-nicks-change':
			//<---
            echo $tsAdmin->ChangeNick_o_no();
			//--->
		break;
        case 'admin-blacklist-delete':
			//<---
            echo $tsAdmin->deleteBlock();
			//--->
		break;
        case 'admin-badwords-delete':
			//<---
            echo $tsAdmin->deleteBadWord();
			//--->
		break;
        default:
            die('0: Este archivo no existe.');
        break;
	}