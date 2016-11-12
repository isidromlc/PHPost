<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Controlador AJAX
 *
 * @name    ajax.posts.php
 * @author  PHPost Team
*/
/**********************************\

*	(VARIABLES POR DEFAULT)		*

\*********************************/

	// NIVELES DE ACCESO Y PLANTILLAS DE CADA ACCIÓN
	$files = array(
        'posts-genbus' => array('n' => 2, 'p' => 'genbus'),
		'posts-preview' => array('n' => 2, 'p' => 'preview'),
		'posts-borrar' =>  array('n' => 2, 'p' => ''),
		'posts-admin-borrar' =>  array('n' => 2, 'p' => ''),
		'posts-votar' =>  array('n' => 2, 'p' => ''),
		'posts-last-comentarios' =>  array('n' => 0, 'p' => 'last-comentarios'),
	);

/**********************************\

* (VARIABLES LOCALES ESTE ARCHIVO)	*

\*********************************/

	// REDEFINIR VARIABLES
	$tsPage = 'php_files/p.posts.'.$files[$action]['p'];
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
	$tsPosts =& tsPosts::getInstance();
	// CODIGO
	switch($action){
		case 'posts-genbus':
			//<--
                $do = htmlspecialchars($_GET['do']);
                $q = $tsCore->setSecure($_POST['q']);
                //
                if($do == 'search'){
                    $smarty->assign("tsPosts",$tsPosts->simiPosts($q));   
                }elseif($do == 'generador'){
                    $tags = $tsPosts->genTags($q);
                    $smarty->assign("tsTags",$tags);
                }
                //
                $smarty->assign("tsDo",$do);
			//-->
		break;
		case 'posts-preview':
			//<--
				$smarty->assign("tsPreview",$tsPosts->getPreview());
			//-->
		break;
		case 'posts-borrar':
			//<--
				echo $tsPosts->deletePost();
			//-->
		break;
		case 'posts-admin-borrar':
			//<--
				echo $tsPosts->deleteAdminPost();
			//-->
		break;
		case 'posts-votar':
			//<--
				echo $tsPosts->votarPost();
			//-->
		break;
		case 'posts-last-comentarios':
			//<--
			    $smarty->assign("tsComments",$tsPosts->getLastComentarios());
			//-->
		break;
	}