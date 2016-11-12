<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Controlador AJAX
 *
 * @name    ajax.recover.php
 * @author  PHPost Team
*/
	$tsLevel = 1; // solo visitantes
	$tsLevelMsg = $tsCore->setLevel($tsLevel, true);
	if($tsLevelMsg != 1){ die('0: '.$tsLevelMsg); }
	
	$email = $tsCore->setSecure($_REQUEST['r_email']);
	$user_info = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT user_id, user_name, user_registro, user_activo FROM u_miembros WHERE user_email = \''.$email.'\'') or die('0: '.show_error('Error al ejecutar la consulta de la l&iacute;nea '.__LINE__.' de '.__FILE__.'.', 'db'));
	if(!db_exec('num_rows', $user_info)){
		die('0: <div class="dialog_box">El email no se encuentra registrado.</div>');
	}

	$tsData = db_exec('fetch_assoc', $user_info);
	
	include(TS_ROOT.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'c.emails.php');

	switch($action){
		case 'recover-pass':
			$tsEmail = new tsEmail('nope', 'chuck testa!'); // wtf
			$key = md5(sha1(uniqid(time().$email.microtime(true), true)));
			db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO w_contacts (user_id, user_email, `time`, `type`, `hash`) VALUES (\''.$tsData['user_id'].'\', \''.$email.'\', \''.time().'\', \'1\', \''.$key.'\')');

			$to = $email;
			$subject = 'Recuperar acceso';
			$body = 'Recuperar contrase&ntilde;a en <strong>'.$tsCore->settings['titulo'].'</strong><br /><br />
			Hola '.$tsData['user_name'].':<br />
			La verificación es usada para asegurar que sólo usted tenga acceso a 
			su cuenta de '.$tsCore->settings['titulo'].' y que, si alguna vez olvida su contrase&ntilde;a, tengamos una forma de generarle una nueva. <br /><br />
			Para recuperar su contrase&ntilde;a, acceda a <a href="'.$tsCore->settings['url'].'/password/'.$key.'/1/'.$tsCore->setSecure($email).'">este enlace</a><br /><br /><br />
			Si usted no pidi&oacute; recuperaci&oacute;n de su contrase&ntilde;a, ignore este e-mail.<br /><br />
			El staff de <strong>'.$tsCore->settings['titulo'].'</strong>';
			
			// <--
			$tsEmail->emailTo = $to;
			$tsEmail->emailSubject = $subject;
			$tsEmail->emailBody = $body;
			$tsEmail->emailHeaders = $tsEmail->setEmailHeaders();
			$tsEmail->sendEmail($from, $to, $subject, $body)  or die('0: Hubo un error al intentar procesar lo solicitado');
			die('1: <div class="dialog_box">Las intrucciones para recuperar su contrase&ntilde;a de <b>'.$tsCore->settings['titulo'].'</b> a <b>'.$email.'</b>, si no aparece el e-mail en su bandeja de entrar, revise en correo no deseado porque puede haberse filtrado..</div>');
			// -->
			break;
		case 'recover-validation':

		if($tsData['user_activo'] == 1) die('0: La cuenta ya se encuentra activada');

     		$tsEmail = new tsEmail($tsData, 'signup');
			$key = md5(sha1(uniqid(time().$email.microtime(true), true)));
			db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO w_contacts (user_id, user_email, `time`, `type`, `hash`) VALUES (\''.$tsData['user_id'].'\', \''.$email.'\', \''.time().'\', \'2\', \''.$key.'\')');

			$to = $email;
			$subject = ''.$tsData['user_name'].', active su cuenta ahora';
			$body = 'Activaci&oacute;n de cuentas en <strong>'.$tsCore->settings['titulo'].'</strong><br /><br />
			Hola '.$tsData['user_name'].':<br />
	        Le enviamos este email para confirmar el registro de
			su cuenta en '.$tsCore->settings['titulo'].'. <br /><br />
			Para terminar el registro y poder acceder a la comunidad, acceda a <a href="'.$tsCore->settings['url'].'/validar/'.$key.'/2/'.$tsCore->setSecure($email).'">este enlace</a><br /><br /><br />
			Si usted no pidi&oacute; recuperaci&oacute;n de su contrase&ntilde;a, ignore este e-mail.<br /><br />
			El staff de <strong>'.$tsCore->settings['titulo'].'</strong>';
			
			// <--
			$tsEmail->emailTo = $to;
			$tsEmail->emailSubject = $subject;
			$tsEmail->emailBody = $body;
			$tsEmail->emailHeaders = $tsEmail->setEmailHeaders();
			$tsEmail->sendEmail($from, $to, $subject, $body)  or die('0: Hubo un error al intentar procesar lo solicitado');
			die('1: <div class="box_cuerpo" style="padding: 12px 20px; border-top:1px solid #CCC">Hemos enviado un correo a <b>'.$email.'</b> con los &uacute;ltimos pasos para finalizar con el registro.<br><br>Si en los pr&oacute;ximos minutos no lo encuentras en tu bandeja de entrada, por favor, revisa tu carpeta de correo no deseado, es posible que se haya filtrado.<br><br>&iexcl;Muchas gracias!</div>');
			// -->
			break;
		default:
			die('0: Este archivo no existe.');
			break;
	}