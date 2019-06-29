<?php if ( ! defined('TS_HEADER')) exit('Que carajo haces master');
/**
 * Controlador AJAX
 *
 * @name    ajax.favoritos.php
 * @author  PHPost Team
*/
/**********************************\

*	(VARIABLES POR DEFAULT)		*

\*********************************/

	// NIVELES DE ACCESO Y PLANTILLAS DE CADA ACCI�N
	$files = array(
		'favoritos' => array('n' => 2, 'p' => 'home'),
		'favoritos-agregar' => array('n' => 2, 'p' => ''),
		'favoritos-borrar' => array('n' => 2, 'p' => ''),
	);

/**********************************\

* (VARIABLES LOCALES ESTE ARCHIVO)	*

\*********************************/

	// REDEFINIR VARIABLES
	$tsPage = 'php_files/p.favoritos.'.$files[$action]['p'];
	$tsLevel = $files[$action]['n'];
	$tsAjax = empty($files[$action]['p']) ? 1 : 0;

/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/
	
	// DEPENDE EL NIVEL
	$tsLevelMsg = $tsCore->setLevel($tsLevel, true);
	if($tsLevelMsg != 1) { echo '0: '.$tsLevelMsg['mensaje']; die();}
	// CLASE
	require('../class/c.posts.php');
	$tsPosts = new tsPosts();
	// CODIGO
	switch($action){
		case 'favoritos':
			//<--
			$smarty->assign("tsFavoritos",$tsPosts->getFavoritos());
			//-->
		break;
		case 'favoritos-agregar':
			//<--
			echo $tsPosts->saveFavorito();
			//-->
		break;
		case 'favoritos-borrar':
			//<--
			echo $tsPosts->delFavorito();
			//-->
		break;
	}
?>