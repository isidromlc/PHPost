<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Controlador AJAX
 *
 * @name    ajax.registro.php
 * @author  PHPost Team
*/
/**********************************\

*	(VARIABLES POR DEFAULT)		*

\*********************************/

	// NIVELES DE ACCESO Y PLANTILLAS DE CADA ACCIÓN
	
	$files = array(
	
		'registro-form' => array('n' => 1, 'p' => 'form'),
		
		'registro-check-nick' => array('n' => 1, 'p' => ''),
		
		'registro-check-email' => array('n' => 1, 'p' => ''),
		
		'registro-geo' => array('n' => 0, 'p' => ''),
		
		'registro-nuevo' => array('n' => 1, 'p' => ''),
		
	);

/**********************************\

* (VARIABLES LOCALES ESTE ARCHIVO)	*

\*********************************/

	// REDEFINIR VARIABLES
	
	$tsPage = 'php_files/p.registro.'.$files[$action]['p'];
	
	$tsLevel = $files[$action]['n'];
	
	$tsAjax = empty($files[$action]['p']) ? 1 : 0;

/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/
	
	// DEPENDE EL NIVEL
	
	$tsLevelMsg = $tsCore->setLevel($tsLevel, true);
	
	if($tsLevelMsg != 1) { echo '0: '.$tsLevelMsg; die();}
	
	// CLASE
	
	require('../class/c.registro.php');
	
	$tsReg = new tsRegistro();
	
	// CODIGO
	
	switch($action){
	
		case 'registro-form':				
		
		if($tsCore->settings['c_reg_active'] == 0){          
		
		$tsAjax = '1';         		
		
		echo '0: <div class="dialog_box">El registro de nuevas cuentas en <b>'.$tsCore->settings['titulo'].'</b> est&aacute; desactivado.</div>';
		
		}else{    
		
			include("../ext/datos.php");
			
			// SOLO MENORES DE 100 AÑOS xD Y MAYORES DE...
			
			$now_year = date("Y",time());
			
			$max_year = 100 - $tsCore->settings['c_allow_edad'];
			
			$end_year = $now_year - $tsCore->settings['c_allow_edad'];
			
			$smarty->assign("tsMax",$max_year);
			
			$smarty->assign("tsEndY",$end_year);
			
			$smarty->assign("tsPaises",$tsPaises);
			
			$smarty->assign("tsMeces",$tsMeces);		

			}
			
		break;
		
		case 'registro-check-nick':	
		
		case 'registro-check-email':	
		
			//<---
			
				echo $tsReg->checkUserEmail();
				
			//--->
			
		break;
		
		case 'registro-geo':
		
			//<--
			
			include("../ext/geodata.php");
			
			$pais = htmlspecialchars($_GET['pais_code']);
			
			//
			
			if($pais) $html = '1: ';
			
			else $html = '0: El campo <b>pais_code</b> es requerido para esta operacion';
			
			foreach($estados[$pais] as $key => $estado){
			
				$html .= '<option value="'.($key+1).'">'.$estado.'</option>'."\n";
				
			}
			
			//
			
			if(strlen($html) > 3) echo $html;
			
			else echo '0: Código de pais incorrecto.';
			
			//-->
			
		break;
		
		case 'registro-nuevo':
		
			//<--
			
                $result = $tsReg->registerUser();
				
				echo $result;
				
			//-->
			
		break;
		
	}