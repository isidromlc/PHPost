<?php 
/**
 * Controlador
 *
 * @name    password.php
 * @author  PHPost Team
*/
/**********************************\

*	(VARIABLES POR DEFAULT)		*

\*********************************/

	$tsPage = "aviso";	// tsPage.tpl -> PLANTILLA PARA MOSTRAR CON ESTE ARCHIVO.

	$tsLevel = 1;		// NIVEL DE ACCESO A ESTA PAGINA. => VER FAQs

	$tsAjax = empty($_GET['ajax']) ? 0 : 1; // LA RESPUESTA SERA AJAX?
	
	$tsContinue = true;	// CONTINUAR EL SCRIPT
	
/*++++++++ = ++++++++*/

	include "../../header.php"; // INCLUIR EL HEADER

	$tsTitle = $_GET['type'] == 1 ? 'Recuperar contrase&ntilde;a ' : 'Validar cuenta '.' - '.$tsCore->settings['titulo'];

/*++++++++ = ++++++++*/
	
	// VERIFICAMOS EL NIVEL DE ACCSESO ANTES CONFIGURADO
	$tsLevelMsg = $tsCore->setLevel($tsLevel, true);
	if($tsLevelMsg != 1){
		$tsAjax = 0;
		$smarty->assign("tsAviso",$tsLevelMsg);
		//
		$tsContinue = false;
	}
	$email = $tsCore->setSecure($_GET['email']);
	//$email = str_replace('/', '@', $tsCore->setSecure($email));
	$type = intval($_GET['type']);
	$key = htmlspecialchars($_GET['hash']);
	$tsData = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT user_id, user_name, user_email FROM u_miembros WHERE user_email = \''.$email.'\'') or exit( show_error('Error al ejecutar la consulta de la l&iacute;nea '.__LINE__.' de '.__FILE__.'.', 'db') );
	// borrar viejos
	db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM `w_contacts` WHERE `time` < \''.(time() - 86400).'\'') or exit( show_error('Error al ejecutar la consulta de la l&iacute;nea '.__LINE__.' de '.__FILE__.'.', 'db') );
	// EXISTE?
	if(!db_exec('num_rows', $tsData)){
		$tsAjax = 0;
		$smarty->assign("tsAviso",array('titulo' => 'Opps!', 'mensaje' => 'No existe ning&uacute;n usuario con ese email', 'but' => 'Ir a p&aacute;gina principal'));
		//
		$tsContinue = false;
	}
	// hash
	$hash = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT * FROM w_contacts WHERE hash = \''.$tsCore->setSecure($key).'\' AND user_email = \''.$email.'\' AND type = '.(int)$type.' ORDER BY id DESC LIMIT 1') or exit( show_error('Error al ejecutar la consulta de la l&iacute;nea '.__LINE__.' de '.__FILE__.'.', 'db') );
	if(!db_exec('num_rows', $hash)){
		$tsAjax = 0;
		$smarty->assign("tsAviso",array('titulo' => 'Opps!', 'mensaje' => 'La clave de validaci&oacute;n no es correcta'));
		//
		$tsContinue = false;
	}
	//
	if($tsContinue){
	$data = db_exec('fetch_assoc', $tsData);
	if($type == 2){
			if(db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_miembros SET user_activo = \'1\' WHERE user_id = \''.$data['user_id'].'\'') or exit( show_error('Error al ejecutar la consulta de la l&iacute;nea '.__LINE__.' de '.__FILE__.'.', 'db') )) {
			db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM w_contacts WHERE user_id = \''.$data['user_id'].'\'') or exit( show_error('Error al ejecutar la consulta de la l&iacute;nea '.__LINE__.' de '.__FILE__.'.', 'db') );
			$smarty->assign('tsAviso', array('titulo' => 'Ok', 'mensaje' => 'Cuenta validada', 'but' => 'Ir a la p&aacute;gina principal'));;
			}else{
			$smarty->assign('tsAviso', array('titulo' => 'Opps', 'mensaje' => 'Ha ocurrido un error', 'but' => 'Reintentar', 'link' => ''.$tsCore->settings['url'].'/validar/'.$key.'/2/'.$email.''));}
			}else{
		if($_POST){
			if(empty($_POST['pass'])){ 
			$smarty->assign('tsAviso', array('titulo' => 'Opps', 'mensaje' => 'Escriba una contrase&ntilde;a', 'but' => 'Volver', 'link' => ''.$tsCore->settings['url'].'/password/'.$key.'/1/'.$email.''));
			}else{
			db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_miembros SET user_password = \''.md5(md5($_POST['pass']).strtolower($data['user_name'])).'\' WHERE user_id = \''.$data['user_id'].'\'') or exit( show_error('Error al ejecutar la consulta de la l&iacute;nea '.__LINE__.' de '.__FILE__.'.', 'db') );
			db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM w_contacts WHERE user_id = \''.$data['user_id'].'\'') or exit( show_error('Error al ejecutar la consulta de la l&iacute;nea '.__LINE__.' de '.__FILE__.'.', 'db') );
			$smarty->assign('tsAviso', array('titulo' => 'Ok', 'mensaje' => 'Contrase&ntilde;a actualizada', 'but' => 'Ir a la p&aacute;gina principal'));
			}
		}else{
			$smarty->assign('tsAviso', array('titulo' => 'Actualizar contrase&ntilde;a', 'mensaje' => '<form method="post">Escribe tu nueva contrase&ntilde;a: <input type="password" name="pass" required/><input type="submit" class="mBtn btnOk" value="Reestablecer contrase&ntilde;a" id="shit" /></form><style type="text/css">#shit{margin-bottom:-45px}</style>'));
		}
	  }
	}
if(empty($tsAjax)) {	// SI LA PETICION SE HIZO POR AJAX DETENER EL SCRIPT Y NO MOSTRAR PLANTILLA, SI NO ENTONCES MOSTRARLA.

	$smarty->assign("tsTitle",$tsTitle);	// AGREGAR EL TITULO DE LA PAGINA ACTUAL

	/*++++++++ = ++++++++*/
	include("../../footer.php");
	/*++++++++ = ++++++++*/
}