<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Controlador AJAX
 *
 * @name    ajax.afiliado.php
 * @author  PHPost Team
*/
/**********************************\

*	(VARIABLES POR DEFAULT)		*

\*********************************/

	// NIVELES DE ACCESO Y PLANTILLAS DE CADA ACCIÓN
	$files = array(
		'afiliado-nuevo' => array('n' => 0, 'p' => ''),
		'afiliado-borrar' => array('n' => 0, 'p' => ''),
		'afiliado-setaction' => array('n' => 0, 'p' => ''),
        'afiliado-url' => array('n' => 0, 'p' => ''),
        'afiliado-detalles' => array('n' => 0, 'p' => 'detalles'),
		'afiliado-editar' => array('n' => 0, 'p' => ''),
	);

/**********************************\

* (VARIABLES LOCALES ESTE ARCHIVO)	*

\*********************************/

	// REDEFINIR VARIABLES
	$tsPage = 'php_files/p.afiliado.'.$files[$action]['p'];
	$tsLevel = $files[$action]['n'];
	$tsAjax = empty($files[$action]['p']) ? 1 : 0;

/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/
	
	// DEPENDE EL NIVEL
	$tsLevelMsg = $tsCore->setLevel($tsLevel, true);
	if($tsLevelMsg != 1) { echo '0: '.$tsLevelMsg['mensaje']; die();}
    // CLASS
    include("../class/c.afiliado.php");
    $tsAfiliado =& tsAfiliado::getInstance();
    //
	// CODIGO
	switch($action){
		case 'afiliado-nuevo':
			//<---
            echo $tsAfiliado->newAfiliado();
			//--->
		break;
		case 'afiliado-borrar':
			//<---
			$aid = $_POST['afid'];
            echo $tsAfiliado->DeleteAfiliado($aid);
			//--->
		break;
		case 'afiliado-editar':
			//<---
			$a_id = $_POST['a_id'];
			$a_name = $_POST['a_name'];
			$a_url = $_POST['a_url'];
			$a_banner = $_POST['a_banner'];
			$a_descripcion = $_POST['a_descripcion'];
			
            echo $tsAfiliado->EditarAfiliado($a_id, $a_name, $a_url, $a_banner, $a_descripcion);
			//--->
		break;
		case 'afiliado-setactive':
			//<---
            echo $tsAfiliado->SetActionAfiliado();
			//--->
		break;
		case 'afiliado-url':
			//<---
            $tsAfiliado->urlOut();
			//--->
		break;
		case 'afiliado-detalles':
			//<---
            $smarty->assign("tsAf",$tsAfiliado->getAfiliado());
			//--->
		break;
        default:
            die('0: Este archivo no existe.');
        break;
	}
?>