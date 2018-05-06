<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Modelo para el control del envio de emails
 *
 * @name    c.emails.php
 * @author  PHPost Team
 */
class tsEmail {
	
	var $email_info = array();		// REFERENCIA PARA ENVIAR UN EMAIL
	var $emailSubject;
	var $emailHeaders;
	var $emailBody;
	var $emailTo;
	var $is_error;		// SI OCURRE UN ERROR ESTA VARIABLE CONTENDRA EL NUMERO DE ERROR

	/*
		$tsEmailRef : tipo de email
		$tsEmailData: datos del email
	*/
	function __construct($tsEmailData,$tsEmailRef){
		$this->email_info = array(
			'ref' => $tsEmailRef,
			'data' => $tsEmailData
			);
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
	/*
		sendEmail()
	*/
	function sendEmail(){
		if(mail($this->emailTo,$this->emailSubject,$this->emailBody,$this->emailHeaders)) return true;
		else return false;
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
		$headers = "MIME-Version: 1.0"."\n";
		$headers .= "Content-type: text/html; charset=utf-8"."\n";
		$headers .= "Content-Transfer-Encoding: 8bit"."\n";
		$headers .= "From: $sender"."\n";
		$headers .= "Return-Path: $sender"."\n";
		$headers .= "Reply-To: $sender\n";
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