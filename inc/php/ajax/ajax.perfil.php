<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Controlador AJAX
 *
 * @name    ajax.perfil.php
 * @author  PHPost Team
*/
/**********************************\

*	(VARIABLES POR DEFAULT)		*

\*********************************/

	// NIVELES DE ACCESO Y PLANTILLAS DE CADA ACCIÓN
	$files = array(
        'perfil-wall' => array('n' => 0, 'p' => 'wall'),
        'perfil-actividad' => array('n' => 0, 'p' => 'actividad'),
		'perfil-info' => array('n' => 0, 'p' => 'info'),
        'perfil-posts' => array('n' => 0, 'p' => 'posts'),
        'perfil-seguidores' => array('n' => 0, 'p' => 'follows'),
        'perfil-siguiendo' => array('n' => 0, 'p' => 'follows'),
        'perfil-medallas' => array('n' => 0, 'p' => 'medallas'),
	);

/**********************************\

* (VARIABLES LOCALES ESTE ARCHIVO)	*

\*********************************/

	// REDEFINIR VARIABLES
	$tsPage = 'php_files/p.perfil.'.$files[$action]['p'];
	$tsLevel = $files[$action]['n'];
	$tsAjax = empty($files[$action]['p']) ? 1 : 0;

/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/
	
	// DEPENDE EL NIVEL
	$tsLevelMsg = $tsCore->setLevel($tsLevel, true);
	if($tsLevelMsg != 1) { echo '0: '.$tsLevelMsg['mensaje']; die();}
    // CLASS
    include("../class/c.cuenta.php");
    $tsCuenta = new tsCuenta();
    // USER ID
    $user_id = (int) $tsCore->setSecure($_POST['pid']);
    if(empty($user_id)) die('0: El campo <b>user_id</b> es obligatorio.');
    $username = $tsUser->getUserName($user_id);
    $smarty->assign("tsUsername",$username);
	// CODIGO
	switch($action){
        case 'perfil-wall':
            include("../class/c.muro.php");
            $tsMuro = new tsMuro();
            // GENERAL
        	$tsGeneral = $tsCuenta->loadGeneral($user_id);
        	$smarty->assign("tsGeneral",$tsGeneral);
            //
            $priv = $tsMuro->getPrivacity($user_id, $username, $tsCuenta->iFollow($user_id));
            if($priv['m']['v'] == true){
                $smarty->assign("tsMuro",$tsMuro->getWall($user_id));
                // INFO
                $tsInfo = array('uid' => $user_id, 'nick' => $username);
                $smarty->assign("tsInfo",$tsInfo);   
            }
            $smarty->assign("tsPrivacidad",$priv);
        break;
        case 'perfil-actividad':
            //<---
            $ac_do = $_POST['do'];
            $ac_type = empty($_POST['ac_type']) ? 0 : (int)$_POST['ac_type'];
            $start = empty($_POST['start']) ? 0 : (int)$_POST['start'];
            //
            if($ac_do != 'borrar'){
                $actividad = $tsActividad->getActividad($user_id, $ac_type, $start);
                $smarty->assign("tsActividad",$actividad);
                $smarty->assign("tsDo",$ac_do);
                $smarty->assign("tsUserID",$user_id);
            } else {
                echo $tsActividad->delActividad();
                die;
            }
            //--->
        break;
		case 'perfil-info':
			//<---
            include('../ext/datos.php');
    		// PERFIL INFO
            $tsPerfil = $tsCuenta->loadPerfil($user_id);
    		$smarty->assign("tsPerfil",$tsPerfil);
            // PAIS
            $smarty->assign("tsPais",$tsPaises[$tsPerfil['user_pais']]);
            // GUSTOS VACIOS?=
            $i = 0;
            foreach($tsPerfil['p_gustos'] as $key => $val){
                if(empty($val)) $i++;
            }
            $tsGustos = ($i > 0) ? 'hide': 'show';
            $smarty->assign("tsGustos",$tsGustos);
    		// PERFIL DATA
    		$smarty->assign("tsPData",$tsPerfilData);
			//--->
		break;
        case 'perfil-posts':
            //<---
            $smarty->assign("tsGeneral",$tsCuenta->loadPosts($user_id));
            //--->
        break;
        case 'perfil-seguidores':
            //<---
            $smarty->assign("tsType",'seguidores');
            $smarty->assign("tsHide",$_GET['hide']); // MOSTRAR DIVS
            $smarty->assign("tsData",$tsMonitor->getFollows('seguidores', $user_id));
            //--->
        break;
        case 'perfil-siguiendo':
            //<---
            $smarty->assign("tsType",'siguiendo');
            $smarty->assign("tsHide",$_GET['hide']); // MOSTRAR DIVS
            $smarty->assign("tsData",$tsMonitor->getFollows('siguiendo', $user_id));
            //--->
        break;
        case 'perfil-medallas':
            //<---
            $smarty->assign("tsMedallas",$tsCuenta->loadMedallas($user_id));
            //--->
        break;
        default:
            die('0: Este archivo no existe.');
        break;
	}
?>