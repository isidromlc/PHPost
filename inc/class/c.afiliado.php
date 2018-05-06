<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Modelo para el control de los afiliados
 *
 * @name    c.afiliado.php
 * @author  PHPost Team
 */
class tsAfiliado {

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*\
								AFILIADOS
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*
		getAfiliadosHome()
	*/
    function getAfiliados($type = 'home'){
        
        //
        if($type == 'home')
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT aid,a_titulo,a_url,a_banner,a_descripcion FROM w_afiliados WHERE a_active = \'1\' ORDER BY RAND() LIMIT 5');
        elseif($type == 'admin')
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT aid,a_titulo,a_url,a_banner,a_descripcion,a_sid,a_hits_in,a_hits_out,a_date,a_active FROM w_afiliados');   
        //
        $data = result_array($query);
        
        //
        return $data;
    }
    /*
        getAfiliado()
    */
    function getAfiliado($type){
        global $tsCore;
        //
        if(!$type){
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT aid,a_titulo,a_url,a_banner,a_descripcion FROM w_afiliados WHERE aid = \''.(int)$_POST['ref'].'\' ');
		}elseif($type = 'admin'){
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT aid,a_titulo,a_url,a_banner,a_descripcion FROM w_afiliados WHERE aid = \''.(int)$_GET['aid'].'\' ');
		}
		$data = db_exec('fetch_assoc', $query);
		
        //
        return $data;
    }
	
    /*
        newAfiliado()
    */
    function newAfiliado(){
        global $tsCore, $tsMonitor;
        //
        $dataIn['titulo'] =htmlspecialchars($tsCore->parseBadWords($_POST['atitle']));
        $dataIn['url'] = htmlspecialchars($tsCore->parseBadWords($_POST['aurl']));
        $dataIn['banner'] = htmlspecialchars($tsCore->parseBadWords($_POST['aimg']));
        $dataIn['desc'] = htmlspecialchars($tsCore->parseBadWords($_POST['atxt']));
        $dataIn['sid'] = htmlspecialchars($_POST['aID']);
        if(!$dataIn['titulo'] || !$dataIn['url'] || $dataIn['url'] == 'http://' || !$dataIn['banner'] || $dataIn['banner'] == 'http://' || !$dataIn['desc']){
          die('2: Faltan datos');
        }
        if(!filter_var(''.$_REQUEST['aurl'].'', FILTER_VALIDATE_URL)){ die('0: Url incorrecta'); }
        //
		if(db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `w_afiliados` (a_titulo, a_url, a_banner, a_descripcion, a_sid, a_date) VALUES (\''.$tsCore->setSecure($dataIn['titulo']).'\', \''.$tsCore->setSecure($dataIn['url']).'\', \''.$tsCore->setSecure($dataIn['banner']).'\', \''.$tsCore->setSecure($dataIn['desc']).'\', \''.intval($dataIn['sid']).'\',\''.time().'\')')) {
		$afid = db_exec('insert_id');
		  // AVISO
            $aviso = '<center><a href="'.$dataIn['url'].'"><img src="'.$dataIn['banner'].'" title="'.$dataIn['titulo'].'"/></a></center> <br /><br /> '.$dataIn['titulo'].' quiere ser su afiliado, dir&iacute;jase a la administraci&oacute;n para aceptar o cancelarla.';
            $tsMonitor->setAviso(1,'Nueva afiliaci&oacute;n', $aviso, 0);
            //
            $entit = $tsCore->settings['titulo'];
            $enurl = $tsCore->settings['url'].'/?ref='.$afid;
            $enimg = $tsCore->settings['banner'];
            //
            $return = '1: <div class="emptyData">Tu afiliaci&oacute;n ha sido agregada!</div><br>';
            $return .= '<div style="padding:0 35px;">Se le ha notificado al administrador tu afiliaci&oacute;n para que la apruebe, mientras tanto copia el siguiente c&oacute;digo, ser&aacute; con el cual nos debes enlazar.<br><br>';
            $return .= '<div class="form-line">';
            $return .= '<label for="atitle">C&oacute;digo HTML</label>';
            $return .= '<textarea tabindex="4" rows="10" style="height:60px; width:295px" onclick"select(this)">';
            $return .= '<a href="'.$enurl.'" target="_blank" title="'.$entit.'"><img src="'.$enimg.'"></a>';
            $return .= '</textarea>';
      		$return .= '</div>';
            $return .= '</div>';
        }
        //
        return $return;
        
    }
	
	function EditarAfiliado(){
        global $tsCore;
        //
		$afiliado = intval($_GET['aid']);
		$titulo = $tsCore->parseBadWords($_POST['af_title']);
		$url = $tsCore->parseBadWords($_POST['af_url']);
		$banner = $tsCore->parseBadWords($_POST['af_banner']);
		$descripcion = $tsCore->parseBadWords($_POST['af_desc']);
       
	   if(!$afiliado || !$titulo || !$url || !$banner || !$descripcion){
          return '0: Faltan datos';
        }
        if(!filter_var($url, FILTER_VALIDATE_URL)){ return '0: Url incorrecta'; }
        //
		if(db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE w_afiliados SET a_titulo = \''.$tsCore->setSecure($titulo).'\', a_url = \''.$tsCore->setSecure($url).'\', a_banner = \''.$tsCore->setSecure($banner).'\', a_descripcion = \''.$tsCore->setSecure($descripcion).'\' WHERE aid= \''.(int)$afiliado.'\'')) {
		return '1: Guardado';
        }else{
		return '0: Ocurri&oacute; un error';
		}
        //
        
        
    }
	
	function DeleteAfiliado($aid){
        global $tsUser;
        //
		if($tsUser->is_admod == 1) {
		if(db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM w_afiliados WHERE aid = \''.(int)$aid.'\''));
		return '1: Afiliado eliminado';
		}else return '0: T%iacute;o, no puedes hacer eso';
    }
	
	function SetActionAfiliado(){
        global $tsUser;
		
		$afiliado = intval($_POST['aid']);
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT a_active FROM w_afiliados WHERE aid = \''.(int)$afiliado.'\'');
        $data = db_exec('fetch_assoc', $query);
        
		
        if($data['a_active'] == 1){
		    if(db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE w_afiliados SET a_active = \'0\' WHERE aid = \''.(int)$afiliado.'\'')) {
			   return '2: Afiliado deshabilitado';
			   }else return '0: Ocurri&oacute, un error';
        } else{
		    if(db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE w_afiliados SET a_active = \'1\' WHERE aid = \''.(int)$afiliado.'\'')) {
			   return '1: Afiliado habilitado.';
        } else return 'Ocurri&oacute; un error';
			}
}	


	/*
        urlOut()
    */
    function urlOut(){
        global $tsCore;
        //
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT a_url,a_sid FROM w_afiliados WHERE aid = \''.intval($_GET['ref']).'\' LIMIT 1');
        $data = db_exec('fetch_assoc', $query);
        
        //
        if(isset($data['a_url'])){
			db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `w_afiliados` SET a_hits_out = a_hits_out + 1 WHERE aid = \''.intval($_GET['ref']).'\'');
            // Y REDIRECCIONAMOS
            $enref = empty($data['a_sid']) ? '/' : '/?ref='.$data['a_sid']; // REFERIDO
            $enurl = $data['a_url'].$enref;
            // REDIRECCIONAMOS
            $tsCore->redirectTo($enurl);
            exit();
        } else $tsCore->redirectTo($tsCore->settings['url']);
    }
    /*
        urlIn()
    */
    function urlIn(){
        global $tsCore;
        //
        $ref = (int)$_GET['ref'];
		
        if($ref > 0) db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `w_afiliados` SET a_hits_in = a_hits_in + 1 WHERE  aid = \''.intval($_GET['ref']).'\'');
        // 
        $tsCore->redirectTo($tsCore->settings['url']);
    }
}