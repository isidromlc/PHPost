<?php 
/**
 * Controlador
 *
 * @name    admin.php
 * @author  PHPost Team
*/

/**********************************\

*	(VARIABLES POR DEFAULT)		*

\*********************************/

	$tsPage = "admin";	// tsPage.tpl -> PLANTILLA PARA MOSTRAR CON ESTE ARCHIVO.

	$tsLevel = 4;		// NIVEL DE ACCESO A ESTA PAGINA. => VER FAQs

	$tsAjax = empty($_GET['ajax']) ? 0 : 1; // LA RESPUESTA SERA AJAX?
	
	$tsContinue = true;	// CONTINUAR EL SCRIPT
	
/*++++++++ = ++++++++*/

	include "../../header.php"; // INCLUIR EL HEADER

	$tsTitle = $tsCore->settings['titulo'].' - '.$tsCore->settings['slogan']; 	// TITULO DE LA PAGINA ACTUAL

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

	// ACTION
	$action = htmlspecialchars($_GET['action']);
	// ACTION 2
	$act = htmlspecialchars($_GET['act']);
	// CLASE POSTS
	include("../class/c.admin.php");
	$tsAdmin =& tsAdmin::getInstance();

/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/
	
	if($action == ''){
		$smarty->assign("tsAdmins",$tsAdmin->getAdmins());
        $smarty->assign("tsInst",$tsAdmin->getInst());
	} elseif($action == 'creditos'){
		$smarty->assign("tsVersion",$tsAdmin->getVersions());
	} elseif($action == 'configs'){
		// GUARDAR CONFIGURACION
		if(!empty($_POST['titulo'])) {
			if($tsAdmin->saveConfig()) $tsCore->redirectTo($tsCore->settings['url'].'/admin/configs?save=true');
		}
    /** NOTICIAS **/
    } elseif($action == 'news'){
        if(empty($act)) $smarty->assign("tsNews",$tsAdmin->getNoticias());
        elseif($act == 'nuevo' && !empty($_POST['not_body'])){
            if($tsAdmin->newNoticia()) $tsCore->redirectTo($tsCore->settings['url'].'/admin/news?save=true');
        } elseif($act == 'editar'){
            if(!empty($_POST['not_body'])){
                if($tsAdmin->editNoticia()) $tsCore->redirectTo($tsCore->settings['url'].'/admin/news?save=true');
            } else $smarty->assign("tsNew",$tsAdmin->getNoticia());
        }  elseif($act == 'borrar'){
          if($tsAdmin->delNoticia()) $tsCore->redirectTo($tsCore->settings['url'].'/admin/news?borrar=true');
		}
	} elseif($action == 'temas'){
		// VER TEMAS
		if(empty($act)){
			$smarty->assign("tsTemas",$tsAdmin->getTemas());
		// EDITAR TEMA
		} elseif($act == 'editar'){
			// GUARDAR
			if(!empty($_POST['save'])){
				if($tsAdmin->saveTema()) $tsCore->redirectTo($tsCore->settings['url'].'/admin/temas?save=true');
			// MOSTRAR
			} else	$smarty->assign("tsTema",$tsAdmin->getTema());
		// CAMBIAR TEMA
		} elseif($act == 'usar'){
			// GUARDAR
			if(!empty($_POST['confirm'])) {
				if($tsAdmin->changeTema()) $tsCore->redirectTo($tsCore->settings['url'].'/admin/temas?save=true');
			}
			// TITULO
			$smarty->assign("tt",$_GET['tt']);
		} elseif($act == 'borrar'){
			// GUARDAR
			if(!empty($_POST['confirm'])) {
				if($tsAdmin->deleteTema()) $tsCore->redirectTo($tsCore->settings['url'].'/admin/temas?save=true');
			}
			// TITULO
			$smarty->assign("tt",$_GET['tt']);
		} elseif($act == 'nuevo'){
			// GUARDAR
			if(!empty($_POST['path'])) {
				$install = $tsAdmin->newTema();
				if($install == 1) $tsCore->redirectTo($tsCore->settings['url'].'/admin/temas?save=true');
				else $smarty->assign("tsError",$install);
			}
		}
	} elseif($action == 'ads'){
		if(!empty($_POST['save'])){
			if($tsAdmin->saveAds()) $tsCore->redirectTo($tsCore->settings['url'].'/admin/ads?save=true');
		}
	// POSTS
	} elseif($action == 'posts'){
		 if(!$act) {
		 $smarty->assign("tsAdminPosts",$tsAdmin->GetAdminPosts());
		 }
	//FOTOS
	} elseif($action == 'fotos'){
		 if(!$act) {
		 $smarty->assign("tsAdminFotos",$tsAdmin->GetAdminFotos());
		 }
	// ESTADÍSTICAS
	} elseif($action == 'stats'){
		 
		 $smarty->assign("tsAdminStats",$tsAdmin->GetAdminStats());
		
	// CAMBIOS DE NOMBRE DE USUARIO
	} elseif($action == 'nicks'){
		 if(!$act) {
		 $smarty->assign("tsAdminNicks",$tsAdmin->getChangeNicks());
		 }elseif($act == 'realizados'){
		 $smarty->assign("tsAdminNicks",$tsAdmin->getChangeNicks_A());
		 }
   // LISTA NEGRA
    } elseif($action == 'blacklist'){
		 if(!$act) {
		 $smarty->assign("tsBlackList",$tsAdmin->getBlackList());
		 }elseif($act == 'editar'){
         if($_POST['edit']){
                $editar = $tsAdmin->saveBlock();
				if($editar == 1) $tsCore->redirectTo($tsCore->settings['url'].'/admin/blacklist?save=true');
				else $smarty->assign("tsError",$editar); $smarty->assign("tsBL",array(value => $_POST['value'], type => $_POST['type']));
         }else $smarty->assign("tsBL",$tsAdmin->getBlock());
		 }elseif($act == 'nuevo'){
		  if($_POST['new']){
                $nuevo = $tsAdmin->newBlock();
				if($nuevo == 1) $tsCore->redirectTo($tsCore->settings['url'].'/admin/blacklist?save=true');
				else $smarty->assign("tsError",$nuevo); $smarty->assign("tsBL",array(value => $_POST['value'], type => $_POST['type'], reason => $_POST['reason']));
          }
          }
          // CENSURAS
          } elseif($action == 'badwords'){
		 if(!$act) {
		 $smarty->assign("tsBadWords",$tsAdmin->getBadWords());
		 }elseif($act == 'editar'){
         if($_POST['edit']){
                $editar = $tsAdmin->saveBadWord();
				if($editar == 1) $tsCore->redirectTo($tsCore->settings['url'].'/admin/badwords?save=true');
				else $smarty->assign("tsError",$editar); $smarty->assign("tsBW",array(word => $_POST['before'], swop => $_POST['after'], method => $_POST['method'], type => $_POST['type']));
         }else $smarty->assign("tsBW",$tsAdmin->getBadWord());
		 }elseif($act == 'nuevo'){
		  if($_POST['new']){
                $nuevo = $tsAdmin->newBadWord();
				if($nuevo == 1) $tsCore->redirectTo($tsCore->settings['url'].'/admin/badwords?save=true');
				else $smarty->assign("tsError",$nuevo); $smarty->assign("tsBW",array(word => $_POST['before'], swop => $_POST['after'], method => $_POST['method'], type => $_POST['type'], reason => $_POST['reason']));
          }
          }
	// CONECTADOS A LA COMUNIDAD
	} elseif($action == 'sesiones'){
		 if(!$act) {
		 $smarty->assign("tsAdminSessions",$tsAdmin->GetSessions());
		 }
    /** MEDALLAS **/
    } elseif($action == 'medals'){
    	// CLASE MEDAL
    	include("../class/c.medals.php");
    	$tsMedal =& tsMedal::getInstance();
        if(empty($act)){
            $smarty->assign("tsMedals",$tsMedal->adGetMedals());
        } elseif($act == 'nueva'){
            if($_POST['save']){
				$agregar = $tsMedal->adNewMedal();
				if($agregar == 1) $tsCore->redirectTo($tsCore->settings['url'].'/admin/medals?save=true');
				else $smarty->assign("tsError",$agregar); $smarty->assign("tsMed",array(m_title => $_POST['med_title'], m_description => $_POST['med_desc'], m_image => $_POST['med_img'], m_cant => $_POST['med_cant'], m_type => $_POST['med_type'], m_cond_user => $_POST['med_cond_user'], m_cond_user_rango => $_POST['med_cond_user_rango'], m_cond_post => $_POST['med_cond_post'], m_cond_foto => $_POST['med_cond_foto']));
            }
				//ICONOS PARA LAS MEDALLAS
				$smarty->assign("tsIcons",$tsAdmin->getExtraIcons('med', 16));
				//RANGOS DISPONIBLES
				$smarty->assign("tsRangos",$tsAdmin->getAllRangos());
            
			} elseif($act == 'showassign'){
				$smarty->assign("tsAsignaciones",$tsMedal->adGetAssign());
         } elseif($act == 'editar'){
            if($_POST['edit']){
                $editar = $tsMedal->editMedal();
				if($editar == 1) $tsCore->redirectTo($tsCore->settings['url'].'/admin/medals?act=editar&mid='.$_GET['mid'].'&save=true');
				else $smarty->assign("tsError",$editar); $smarty->assign("tsMed",array(m_title => $_POST['med_title'], m_description => $_POST['med_desc'], m_image => $_POST['med_img'], m_cant => $_POST['med_cant'], m_type => $_POST['med_type'], m_cond_user => $_POST['med_cond_user'], m_cond_user_rango => $_POST['med_cond_user_rango'], m_cond_post => $_POST['med_cond_post'], m_cond_foto => $_POST['med_cond_foto']));
            }else $smarty->assign("tsMed",$tsMedal->adGetMedal());  //DATOS DE LA MEDALLA
				// ICONOS PARA LA MEDALLA
				$smarty->assign("tsIcons",$tsAdmin->getExtraIcons('med', 16));
				//RANGOS DISPONIBLES
				$smarty->assign("tsRangos",$tsAdmin->getAllRangos());
                
        }					/* } elseif($action == 'afs'){		// CLASS			include("../class/c.afiliado.php");		$tsAfiliado =& tsAfiliado::getInstance();		// QUE HACER			if($act == ''){		// AFILIADOS		$smarty->assign("tsAfiliados",$tsAfiliado->getAfiliados('admin'));  	}elseif($act == 'editar' ){  	if(!empty($_POST['save'])){			if($tsAfiliado->saveAfiliado()) 	$tsCore->redirectTo($tsCore->settings['url'].'/admin/afs?save=true');		}  else {// MOSTRAR	$smarty->assign("tsAfiliados",$tsAfiliado->getAfiliado2());		}		 }elseif($act == 'activar' ){ 	if(!empty($_POST['save'])){				if($tsAfiliado->save2Afiliado()) 	$tsCore->redirectTo($tsCore->settings['url'].'/admin/afs?save=true');		}  else {// MOSTRAR	$smarty->assign("tsAfiliados",$tsAfiliado->getAfiliado());			}		 		 			}elseif($act == 'borrar'){			if(!empty($_POST['confirm'])){		if($tsAfiliado->deleteAfiliado()) 	$tsCore->redirectTo($tsCore->settings['url'].'/admin/afs?save=true');			}	   			}elseif($act == 'nueva' ){		if($_POST['save']){			if($tsAfiliado->newAfiliado()) 	$tsCore->redirectTo($tsCore->settings['url'].'/admin/afs?save=true');	}		} */
	} elseif($action == 'afs'){
        // CLASS
        include("../class/c.afiliado.php");
        $tsAfiliado =& tsAfiliado::getInstance();
        // QUE HACER
	   if($act == ''){
        // AFILIADOS
        $smarty->assign("tsAfiliados",$tsAfiliado->getAfiliados('admin'));
	   } elseif($act == 'editar'){
            if($_POST['edit']){
                if($tsAfiliado->EditarAfiliado()) $tsCore->redirectTo($tsCore->settings['url'].'/admin/afs?act=editar&aid='.$_GET['aid'].'&save=true');
            }
				$smarty->assign("tsAf",$tsAfiliado->getAfiliado('admin'));

                
        }
	} elseif($action == 'pconfigs'){
		if(!empty($_POST['save'])){
			if($tsAdmin->savePConfigs()) $tsCore->redirectTo($tsCore->settings['url'].'/admin/pconfigs?save=true');
		}
	} elseif($action == 'cats'){
		if(!empty($_GET['ordenar'])){
			$tsAdmin->saveOrden();
		} elseif($act == 'editar'){
			if($_POST['save']){
				if($tsAdmin->saveCat()) $tsCore->redirectTo($tsCore->settings['url'].'/admin/cats?save=true');
			} else {
				$smarty->assign("tsType",$_GET['t']);
				$smarty->assign("tsCat",$tsAdmin->getCat());
				// SOLO LAS CATEGORIAS TIENEN ICONOS
				$smarty->assign("tsIcons",$tsAdmin->getExtraIcons());
			}
		} elseif($act == 'nueva'){
			if($_POST['save']){
				if($tsAdmin->newCat()) $tsCore->redirectTo($tsCore->settings['url'].'/admin/cats?save=true');
			} else {
				$smarty->assign("tsType",$_GET['t']);
				$smarty->assign("tsCID",$_GET['cid']);
				$smarty->assign("tsIcons",$tsAdmin->getExtraIcons());
			}
		} elseif($act == 'change'){
			if($_POST['save']){
				if($tsAdmin->MoveCat()) $tsCore->redirectTo($tsCore->settings['url'].'/admin/cats?save=true');
			}
		} elseif($act == 'borrar'){
			if($_POST['save']){
				// BORRAR CATEGORIA
				if($_GET['t'] == 'cat'){
					$save = $tsAdmin->delCat();
					if($save == 1) $tsCore->redirectTo($tsCore->settings['url'].'/admin/cats?save=true');
					else $smarty->assign("tsError",$save); 
				// BORRAR SUBCATEGORIA
				} elseif($_GET['t'] == 'sub'){
					$save = $tsAdmin->delSubcat();
					if($save == 1) $tsCore->redirectTo($tsCore->settings['url'].'/admin/cats?save=true');
					else $smarty->assign("tsError",$save); 
				}
			}
			//
			$smarty->assign("tsType",$_GET['t']);
			$smarty->assign("tsCID",$_GET['cid']);
			$smarty->assign("tsSID",$_GET['sid']);
		}
	} elseif($action == 'rangos'){
			// PORTADA
			if(empty($act)) {
				$smarty->assign("tsRangos",$tsAdmin->getRangos());
			// LISTAR USUARIOS DEPENDIENDO EL RANGO
			} elseif($act == 'list'){
				$smarty->assign("tsMembers",$tsAdmin->getRangoUsers());
			// EDITAR RANGO
			} elseif($act == 'editar'){
				if(!empty($_POST['save'])){
					if($tsAdmin->saveRango()) $tsCore->redirectTo($tsCore->settings['url'].'/admin/rangos?save=true');
				} else {
					$smarty->assign("tsRango",$tsAdmin->getRango());
					$smarty->assign("tsIcons",$tsAdmin->getExtraIcons('ran'));
                    $smarty->assign("tsType",$_GET['t']);
				}
			// NUEVO RANGO
			} elseif($act == 'nuevo'){
				if(!empty($_POST['save'])){
					$save = $tsAdmin->newRango();
					if($save == 1) $tsCore->redirectTo($tsCore->settings['url'].'/admin/rangos?save=true');
					else {
						$smarty->assign("tsError",$save); 
						$smarty->assign("tsIcons",$tsAdmin->getExtraIcons('ran'));
					}
				} else {
					$smarty->assign("tsIcons",$tsAdmin->getExtraIcons('ran'));
                    $smarty->assign("tsType",$_GET['t']);
				}
			} elseif($act == 'borrar'){
				if(empty($_POST['save'])){
					$smarty->assign("tsRangos",$tsAdmin->getAllRangos());
				}else{
					if($tsAdmin->delRango()) $tsCore->redirectTo($tsCore->settings['url'].'/admin/rangos?save=true');
				}
			}
			// CAMBIAR RANGO PREDETERMINADO DEL REGISTRO
			elseif($act == 'setdefault'){
					if($tsAdmin->SetDefaultRango()) $tsCore->redirectTo($tsCore->settings['url'].'/admin/rangos?save=true');
			}
	} elseif($action == 'users'){
	   if(empty($act)){
	       $smarty->assign("tsMembers",$tsAdmin->getUsuarios());
	   }elseif($act == 'show'){
	       $do = $_GET['t'];
           $user_id = $_GET['uid'];
           // HACER
           switch($do){
				case 5:
        	       if(!empty($_POST['save'])){
        	           $update = $tsAdmin->setUserPrivacidad($user_id);
        	           if($update == 'OK') $tsCore->redirectTo($tsCore->settings['url'].'/admin/users?act=show&uid='.$user_id.'&save=true');
                       else $smarty->assign("tsError",$update);
                    }
					include('../ext/datos.php');
                    $smarty->assign("tsPerfil",$tsAdmin->getUserPrivacidad());
					$smarty->assign("tsPrivacidad",$tsPrivacidad);
                break;
                case 6:
        	       if(!empty($_POST['save'])){
        	           $delete = $tsAdmin->deleteContent($user_id);
        	           if($delete == 'OK') $tsCore->redirectTo($tsCore->settings['url'].'/admin/users?act=show&uid='.$user_id.'&save=true');
                       else $smarty->assign("tsError",$delete);
                    }
					include('../ext/datos.php');
                    $smarty->assign("tsPerfil",$tsAdmin->getUserPrivacidad());
					$smarty->assign("tsPrivacidad",$tsPrivacidad);
                break;
                case 7:
        	       if(!empty($_POST['save'])){
        	           $update = $tsAdmin->setUserRango($user_id);
        	           if($update == 'OK') $tsCore->redirectTo($tsCore->settings['url'].'/admin/users?act=show&uid='.$user_id.'&save=true');
                       else $smarty->assign("tsError",$update);
                    }
                    $smarty->assign("tsUserR",$tsAdmin->getUserRango($user_id));
                break;
				case 8:
        	       if(!empty($_POST['save'])){
        	           $update = $tsAdmin->setUserFirma($user_id);
        	           if($update == 'OK') $tsCore->redirectTo($tsCore->settings['url'].'/admin/users?act=show&uid='.$user_id.'&save=true');
                       else $smarty->assign("tsError",$update);
                    }
					$smarty->assign("tsUserF",$tsAdmin->getUserData());
                break;
                default:
                    if(!empty($_POST['save'])){
        	           $update = $tsAdmin->setUserData($user_id);
        	           if($update == 'OK') $tsCore->redirectTo($tsCore->settings['url'].'/admin/users?act=show&uid='.$user_id.'&save=true');
                       else $smarty->assign("tsError",$update);
                    }
    	           $smarty->assign("tsUserD",$tsAdmin->getUserData());
                break;
           }
           // TIPO
           $smarty->assign("tsType",$_GET['t']);
           $smarty->assign("tsUserID",$user_id);
           $smarty->assign("tsUsername",$tsUser->getUserName($user_id));
	   }
	}

/**********************************\

* (AGREGAR DATOS GENERADOS | SMARTY) *

\*********************************/
	// ACCION?
	$smarty->assign("tsAction",$action);
	//
	$smarty->assign("tsAct",$act);
	//
	}

if(empty($tsAjax)) {	// SI LA PETICION SE HIZO POR AJAX DETENER EL SCRIPT Y NO MOSTRAR PLANTILLA, SI NO ENTONCES MOSTRARLA.

	$smarty->assign("tsTitle",$tsTitle);	// AGREGAR EL TITULO DE LA PAGINA ACTUAL
	
	$smarty->assign("tsSave",$_GET['save']);	// AGREGAR EL TITULO DE LA PAGINA ACTUAL
	
	/*++++++++ = ++++++++*/
	include("../../footer.php");
	/*++++++++ = ++++++++*/
}