<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Controlador AJAX
 *
 * @name    ajax.notificaciones.php
 * @author  PHPost Team
*/
/**********************************\

*	(VARIABLES POR DEFAULT)		*

\*********************************/

	// NIVELES DE ACCESO Y PLANTILLAS DE CADA ACCIÓN
	$files = array(
		'notificaciones-ajax' => array('n' => 2, 'p' => 'ajax'),
        'notificaciones-filtro' => array('n' => 2, 'p' => ''),
	);

/**********************************\

* (VARIABLES LOCALES ESTE ARCHIVO)	*

\*********************************/

	// REDEFINIR VARIABLES
	$tsPage = 'php_files/p.notificaciones.'.$files[$action]['p'];
	$tsLevel = $files[$action]['n'];
	$tsAjax = empty($files[$action]['p']) ? 1 : 0;
	//
	$how = $_POST['action'];

/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/
	
	// DEPENDE EL NIVEL
	$tsLevelMsg = $tsCore->setLevel($tsLevel, true);
	if($tsLevelMsg != 1) { echo '0: '.$tsLevelMsg; die();}
	// CODIGO
	
	switch($action){
		case 'notificaciones-ajax':
			$tsAjax = 1; // AJAX
			switch($how){
				case 'last':
					// <--
					$tsAjax = 0; // AJAX
					$notificaciones = $tsMonitor->getNotificaciones();
					$smarty->assign("tsData",$notificaciones['data']);
					// -->
				break;
				case 'follow':
					// <--
						echo $tsMonitor->setFollow();
					// -->
				break;
				case 'unfollow':
					// <--
						echo $tsMonitor->setUnFollow();
					// -->
				break;
				case 'spam':
					// <--
						echo $tsMonitor->setSpam();
					// -->
				break;
			}
		break;
        case 'notificaciones-filtro':
            echo $tsMonitor->setFiltro();
        break;
	}
	
	// HACK xD
	$_GET['ts'] = true;
?>