<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Controlador AJAX
 *
 * @name    ajax.moderacion.php
 * @author  PHPost Team
*/
/**********************************\

*	(VARIABLES POR DEFAULT)		*

\*********************************/

	// NIVELES DE ACCESO Y PLANTILLAS DE CADA ACCIÓN
	$files = array(
		'moderacion-posts' => array('n' => 3, 'p' => 'main'),
		'moderacion-fotos' => array('n' => 3, 'p' => 'main'),
        'moderacion-users' => array('n' => 3, 'p' => 'main'),
		'moderacion-mps' => array('n' => 3, 'p' => 'main'),
	);

/**********************************\

* (VARIABLES LOCALES ESTE ARCHIVO)	*

\*********************************/

	// REDEFINIR VARIABLES
    $tsPage = 'php_files/p.moderacion.'.$files[$action]['p'];
	$tsLevel = $files[$action]['n'];
	$tsAjax = empty($files[$action]['p']) ? 1 : 0;

/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/
	
	// DEPENDE EL NIVEL
	$tsLevelMsg = $tsCore->setLevel($tsLevel, true);
	if($tsLevelMsg != 1) { echo '0: '.$tsLevelMsg['mensaje']; die();}
	// CLASE
	require('../class/c.moderacion.php');
	$tsMod = new tsMod();
    //
    $do = htmlspecialchars($_GET['do']);
	// CODIGO
	switch($action){
		case 'moderacion-posts':
			//<--
                // POST ID
                $pid = (int)$_POST['postid'];
                // ACCIONES SECUNDARIAS
                switch($do){
                    case 'view':
                        $tsPage = 'php_files/p.posts.preview';
                        $preview = $tsMod->getPreview($pid);
                        $smarty->assign("tsPreview",$preview);
                    break;
					case 'ocultar':
                        $tsAjax = 1;
                        echo $tsMod->OcultarPost($_POST['pid'], $tsCore->setSecure($_POST['razon']));
                    break;
                    case 'reboot':
                        $tsAjax = 1;
                        echo $tsMod->rebootPost($_POST['id']);
                    break;
                    case 'borrar':
                        if($_POST['razon']){
                            $tsAjax = 1;
                            echo $tsMod->deletePost($pid);
                        }else {
                            include("../ext/datos.php");
                            $tsPage = 'php_files/p.posts.mod';
                            $smarty->assign("tsDenuncias",$tsDenuncias['posts']);   
                        }
                    break;
                    case 'sticky':
                        $tsAjax = 1;
                        echo $tsMod->setSticky($_POST['id']);
                    break;
					case 'openclosed':
                        $tsAjax = 1;
                        echo $tsMod->setOpenClosed($_POST['id']);
                    break;
                }
			//-->
		break;
		case 'moderacion-users':
			//<--
                // POST ID
                $user_id = $_POST['uid'];
                $username = $tsUser->getUserName($user_id);
                // ACCIONES SECUNDARIAS
                switch($do){
                    case 'aviso':
                        if($_POST['av_body']){
                            $tsAjax = 1;
                            $aviso = $_POST['av_body']."\n\n".'Staff: <a href="#" class="hovercard" uid="'.$tsUser->uid.'">'.$tsUser->nick.'</a>';
                            $aviso_resp = $tsMonitor->setAviso($user_id, $_POST['av_subject'], $aviso, $_POST['av_type']);
                            if(!$aviso_resp) echo '0: Error al enviar el aviso a <b>'.$username.'</b>.';
                            else echo '1: El avioso fue enviado con &eacute;xito a <b>'.$username.'</b>.';
                        } else $smarty->assign("tsUsername", $tsUser->getUserName($user_id));
                    break;
                    case 'ban':
                        if($_POST['b_causa']){
                            $tsAjax = 1;
                            echo $tsMod->banUser($user_id);
                        }  else $smarty->assign("tsUsername", $tsUser->getUserName($user_id));
                    break;
                    case 'unban':
                        $tsAjax = 1;
                        echo $tsMod->rebootUser($_POST['id'], 'unban');
                    break;
                    case 'reboot':
                        $tsAjax = 1;
                        echo $tsMod->rebootUser($_POST['id'], 'reboot');
                    break;
					case 'info':
                        $tsAjax = 1;
						//echo $tsMod->InfoUser($_POST['user_id']);
						echo $smarty->assign("tsIUser", $tsMod->InfoUser($_POST['user_id']));
                    break;
					case 'editar':
                        $tsAjax = 1;
                        echo $tsMod->EditarUser($_POST['user_id']);
                    break;
                }
                // HACER
                $smarty->assign("tsDo",$do);
			//-->
		break;
		case 'moderacion-mps':
			//<--
                // MP ID
                $mid = $_POST['mpid'];
                // ACCIONES SECUNDARIAS
                switch($do){
                    case 'reboot':
                            $tsAjax = 1;
                            echo $tsMod->rebootMps($_POST['id']);
                    break;
                    case 'borrar':
                            $tsAjax = 1;
                            echo $tsMod->deleteMps($mid);
                    break;
                }
			//-->
		break;
		case 'moderacion-fotos':
			//<--
                $fid = (int)$_POST['fid'];
                // ACCIONES SECUNDARIAS
                switch($do){
                    case 'reboot':
                            $tsAjax = 1;
                            echo $tsMod->rebootFoto($_POST['id']);
                    break;
                    case 'borrar':
						if($_POST['razon']){
                            $tsAjax = 1;
                            echo $tsMod->deleteFoto($fid);
                        }else {
                            include('../ext/datos.php');
                            $tsPage = 'php_files/p.fotos.mod';
                            $smarty->assign("tsDenuncias",$tsDenuncias['fotos']);   
                        }
                    break;
                }
			//-->
		break;

	}
?>