<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Controlador AJAX
 *
 * @name    ajax.muro.php
 * @author  PHPost Team
*/
/**********************************\

*	(VARIABLES POR DEFAULT)		*

\*********************************/

	// NIVELES DE ACCESO Y PLANTILLAS DE CADA ACCIÓN
	$files = array(
		'muro-stream' => array('n' => 2, 'p' => 'stream'),
        'muro-likes' => array('n' => 2, 'p' => '')
	);

/**********************************\

* (VARIABLES LOCALES ESTE ARCHIVO)	*

\*********************************/

	// REDEFINIR VARIABLES
	$tsPage = 'php_files/p.muro.'.$files[$action]['p'];
	$tsLevel = $files[$action]['n'];
	$tsAjax = empty($files[$action]['p']) ? 1 : 0;

/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/
	
	// DEPENDE EL NIVEL
	$tsLevelMsg = $tsCore->setLevel($tsLevel, true);
	if($tsLevelMsg != 1) { echo '0: '.$tsLevelMsg['mensaje']; die();}
    // CLASS
    include("../class/c.muro.php");
    $tsMuro = new tsMuro();
    //
	// CODIGO
	switch($action){
		case 'muro-stream':
			//<---
            $do = $_GET['do'];
            //
            if($do == 'check'){
                echo $tsMuro->ajaxCheck();
                $tsAjax = 1;
            } elseif($do == 'post'){
                $tsStream = $tsMuro->streamPost();
                if(!is_array($tsStream) && substr($tsStream,0,1) == '0') {
                    echo $tsStream;
                    $tsAjax = 1;
                }
                else {
                    // ASIGNAMOS
                    $tsWall['data'][1] = $tsStream;
                    $smarty->assign("tsMuro",$tsWall);
                    $tsPrivacidad['mf']['v'] = true;
                    $smarty->assign("tsPrivacidad", $tsPrivacidad);  
                } 
            } elseif($do == 'more'){
                // CLASS
                include("../class/c.cuenta.php");
                $tsCuenta = new tsCuenta();
                // VARIABLES
                $user_id = $tsCore->setSecure($_POST['pid']);
                $start = $tsCore->setSecure($_POST['start']);
                //
                $priv = $tsMuro->getPrivacity($user_id, 'null', $tsCuenta->iFollow($user_id));
                $smarty->assign("tsPrivacidad",$priv);
                //
                if($_GET['type'] == 'wall') $tsStream = $tsMuro->getWall($user_id,$start);
                else if($_GET['type'] == 'news') $tsStream = $tsMuro->getNews($start);
                // ASIGNAMOS
                if(!is_array($tsStream)) {
                    echo $tsStream;
                    $tsAjax = 1;   
                }
                else {
                    $smarty->assign("tsMuro",$tsStream);            
                }  
            } elseif($do == 'repost'){
                $tsPage = 'php_files/p.muro.stream.comments'; // TEMPLATE
                // VARIABLES
                $tsRepost = $tsMuro->streamRepost();
                // ASIGNAMOS
                if(!is_array($tsRepost)) {
                    echo $tsRepost;
                    $tsAjax = 1;   
                }
                else {
                    $tsComments['data'][1] = $tsRepost;
                    $smarty->assign("tsComments",$tsComments);  
                } 
            } elseif($do == 'more_comments'){
                $tsPage = 'php_files/p.muro.stream.comments'; // TEMPLATE
                // VARIABLES
                $tsComments = $tsMuro->getComments();
                // ASIGNAMOS
                if(!is_array($tsComments)) {
                    echo $tsComments;
                    $tsAjax = 1;
                }
                else {
                    
                    $smarty->assign("tsComments",$tsComments);
                }
            } elseif($do == 'delete'){
                echo $tsMuro->deletePost();
                $tsAjax = 1;
            }
			//--->
		break;
        case 'muro-likes':
            //<---
            if(empty($_GET['do']))
                echo $tsCore->setJSON($tsMuro->likePost());
            else {
                echo $tsCore->setJSON($tsMuro->showLikes());
            }
            //--->
        break;
        default:
            die('0: Este archivo no existe.');
        break;
	}