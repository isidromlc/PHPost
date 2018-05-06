<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Controlador AJAX
 *
 * @name    ajax.borradores.php
 * @author  PHPost Team
*/
/**********************************\

*	(VARIABLES POR DEFAULT)		*

\*********************************/

	// NIVELES DE ACCESO Y PLANTILLAS DE CADA ACCIÓN
	$files = array(
		'borradores' => array('n' => 2, 'p' => 'home'),
		'borradores-agregar' => array('n' => 2, 'p' => ''),
		'borradores-guardar' => array('n' => 2, 'p' => ''),
		'borradores-eliminar' => array('n' => 2, 'p' => ''),
		'borradores-get' => array('n' => 2, 'p' => ''),
	);

/**********************************\

* (VARIABLES LOCALES ESTE ARCHIVO)	*

\*********************************/

	// REDEFINIR VARIABLES
	$tsPage = 'php_files/p.borradores.'.$files[$action]['p'];
	$tsLevel = $files[$action]['n'];
	$tsAjax = empty($files[$action]['p']) ? 1 : 0;

/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/
	
	// DEPENDE EL NIVEL
	$tsLevelMsg = $tsCore->setLevel($tsLevel, true);
	if($tsLevelMsg != 1) { echo '0: '.$tsLevelMsg['mensaje']; die();}
	// CLASE
	require('../class/c.borradores.php');
	$tsDrafts = new tsDrafts();
	// CODIGO
	switch($action){
		case 'borradores':
				$tsBorradores = $tsDrafts->getDrafts();
				$smarty->assign("tsDrafts",$tsBorradores);
		break;
		case 'borradores-get':
				$_GET['action'] = $_POST['borrador_id'];
				$tsBorrador = $tsDrafts->getDraft(0);
				echo '1: <div style="text-align:left; padding-left:15px;">
	<strong>T&iacute;tulo:</strong><br />
	<input type="text" value="'.$tsBorrador['b_title'].'" style="width:480px" onfocus="this.select()" /><br />
	<strong>Cuerpo:</strong><br />
	<textarea style="width:490px; height:140px" onfocus="this.select()">'.$tsBorrador['b_body'].'</textarea>
</div>';
		break;
		case 'borradores-agregar':
			//<--
			echo $tsDrafts->newDraft();
			//-->
		break;
		case 'borradores-guardar':
			//<--
			echo $tsDrafts->newDraft(true);
			//-->
		break;
		case 'borradores-eliminar':
			//<--
			echo $tsDrafts->delDraft();
			//-->
		break;
	}
?>