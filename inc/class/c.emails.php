<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Modelo para el control del envio de emails
 *
 * @name    c.emails.php
 * @author  PHPost Team
 */
class tsEmail {
	
	var $email_info = [];		// REFERENCIA PARA ENVIAR UN EMAIL
	var $emailSubject;
	var $emailHeaders;
	var $emailBody;
	var $emailTo;
	var $is_error;		// SI OCURRE UN ERROR ESTA VARIABLE CONTENDRA EL NUMERO DE ERROR

	/*
		$tsEmailRef : tipo de email
		$tsEmailData: datos del email
	*/
	function __construct($tsEmailData, $tsEmailRef){
		$this->email_info = [
			'ref' => $tsEmailRef,
			'data' => $tsEmailData
		];
	}
	/*
		setEmailInfo()
	*/
	function setEmail(){
		$this->emailSubject = $this->setEmailSubject();
		$this->emailHeaders = $this->setEmailHeaders();
		$this->emailBody = $this->setEmailBody();
		$this->emailTo = $this->email_info['user_email'];
	}
	/**
	 * Reemplazamos el contenido
	*/
	function replaceHTML($body) {
		global $tsCore;
		$emailBody = file_get_contents(TS_EXTRA . "emails/basic.html");
		$emailBody = str_replace(
		   ["_WEBSITE_", "_CONTENTBODY_", "_LOGOWEB_", "_TERMS_", "_PRIV_"], 
		   [
		      $tsCore->settings['titulo'],
		      $body,
		      $tsCore->settings['images'] . '/phpostmin.gif',
		      $tsCore->settings['url'] . "/pages/terminos-y-condiciones/",
		      $tsCore->settings['url'] . "/pages/privacidad/"
		   ],
		   $emailBody
		);
		return $emailBody;
	}
	/*
		sendEmail()
	*/
	function sendEmail() {
		$mail = mail(
			$this->emailTo,
			$this->emailSubject,
			$this->replaceHTML($this->emailBody),
			$this->emailHeaders
		);	
		return ($mail) ? true : false;
	}
	/*
		setEmailSubject()
	*/
	function setEmailSubject(){
		switch($this->email_info['ref']) {
			case 'signup' :
				$subject = "Por favor completa tu registro.";
			break;
		}
	
		// ENCODE SUBJECT FOR UTF8
		return "=?UTF-8?B?".base64_encode($subject)."?=";
	}
	/*
		setEmailHeaders()
	*/
	function setEmailHeaders(){
		global $tsCore;
		// SET HEADERS
		$sender = $tsCore->settings['titulo']." <no-reply@".$tsCore->settings['domain'].">";
		//
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "Content-Transfer-Encoding: 8bit\r\n";
    	$headers .= "X-Priority: 1\n"; // Urgent message!
		$headers .= "From: {$sender}\r\n";
		$headers .= "Return-Path: {$sender}\r\n";
		$headers .= "Reply-To: {$sender}\r\n";
		//
		return $headers;
	}
	/*
		setEmailBody()
	*/
	function setEmailBody(){
		switch($this->email_info['ref']) {
			case 'signup' :
				return $this->setRegisterEmail();
			break;
		}
	}
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
}