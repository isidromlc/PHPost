<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Modelo para el control de los mensajes privados
 *
 * @name    c.mensajes.php
 * @author  PHPost Team
 */
class tsMensajes {
    
    var $mensajes = 0; // SIN LEER

	// INSTANCIA DE LA CLASE
	function __construct(){
		global $tsUser;
		// VISITANTE?
		if(empty($tsUser->is_member)) return false;
		// MENSAJES
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(mp_id) AS total FROM u_mensajes WHERE mp_to = \''.$tsUser->uid.'\'  && mp_read_mon_to < \'2\' && mp_del_to = \'0\'');
		$data = db_exec('fetch_assoc', $query);
		
        $this->mensajes = $data['total'];
        // RESPUESTAS
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(mp_id) AS total FROM u_mensajes WHERE mp_answer = \'1\' && mp_from = \''.$tsUser->uid.'\' && mp_read_mon_from < \'2\' && mp_del_from = \'0\'');
		$data = db_exec('fetch_assoc', $query);
		
		$this->mensajes = $this->mensajes + $data['total'];
        //
	}
	
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*\
	                           MENSAJES PERSONALES
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    /*
        getValid() // Comprobamos si el usuario ingresado es válido para enviar el mensaje.
    */
    function getValid(){
        global $tsCore, $tsUser;
        //
        $para = $tsCore->setSecure(strtolower($_POST['para']));
        //
        if($para == strtolower($tsUser->nick)) return '1';
        //
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT user_id FROM u_miembros WHERE LOWER(user_name) = \''.$tsCore->setSecure($para).'\' LIMIT 1');        
		$exists = db_exec('num_rows', $query);        
		
        //
        if(empty($exists)) return '2';
        else return '0';
    }
    /**
     * @name newMensaje
     * @access public
     * @param string
     * @return string;
     * @info ENVIA UN NUEVO MENSAJE
    */
    function newMensaje(){
        global $tsCore, $tsUser, $tsCuenta;
        #
		if($tsUser->is_member && $tsUser->info['user_baneado'] == 0 && $tsUser->info['user_activo'] == 1) {
		//ANTI FLOOD ._.
		$antiflood = $tsUser->permisos['goaf']*5;
		$mensajito = $tsCore->setSecure(substr($_POST['mensaje'],0,75), true);
		if(db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT mp_id FROM `u_mensajes` WHERE (mp_date > \''.(time()-$antiflood).'\' && mp_from = \''.$tsUser->uid.'\') OR (mp_date > \''.(time()-$antiflood*3600).'\' && mp_from = \''.$tsUser->uid.'\' && mp_preview = \''.$mensajito.'\' && `mp_subject` = \''.$tsCore->setSecure($_POST['asunto']).'\') ORDER BY mp_id DESC LIMIT 1'))) die('Espere '.$antiflood.' segundos para continuar'); 
		$tsCore->antiFlood(true, 'mps');
		//
        $para = $tsCore->setSecure($_POST['para'], true);
        $asunto = empty($_POST['asunto']) ? '(sin asunto)' : $tsCore->setSecure($tsCore->parseBadWords($_POST['asunto']), true);
        $mensaje = substr($_POST['mensaje'],0,1000);
        if(str_replace(array("\n","\t",' '),'',$mensaje) == '') die('Debes ingresar el contenido de tu mensaje.');
        //
        $user_id = $tsUser->getUserID($para);
		if (!empty($user_id) && !empty($mensaje)) {
        //BLOQUEADO
        if (!$tsUser->is_admod) {
            $block = db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT bid FROM u_bloqueos WHERE (b_user = \'' . $user_id . '\' && b_auser = \'' . $tsUser->uid . '\') || (b_user = \'' . $tsUser->uid . '\' && b_auser = \'' . $user_id . '\') LIMIT 1'));
            if ($block) die('No puedes enviarle mensajes a ' . $para);
        }
        //VISTA PREVIA
        $preview = substr($mensaje,0,75);
         
		$com = db_exec('fetch_assoc', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT user_activo, user_baneado FROM u_miembros WHERE LOWER(user_name) = \''.$tsCore->setSecure($para).'\''));
		if($com['user_activo'] != 0 && $com['user_baneado'] != 1){
		
		$comp = db_exec('fetch_assoc', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT (SELECT COUNT(follow_id) FROM u_follows WHERE f_id = \''.(int)$user_id.'\' AND f_user = \''.(int)$tsUser->uid.'\' AND f_type = \'1\' LIMIT 1) as lesigo, (SELECT COUNT(follow_id) FROM u_follows WHERE f_id = \''.(int)$tsUser->uid.'\' AND f_user = \''.(int)$user_id.'\' AND f_type = \'1\' LIMIT 1) as mesigue, (SELECT COUNT(user_id) FROM u_miembros WHERE user_id = \''.$user_id.'\' AND user_rango < \'2\' LIMIT 1) as noesunadmin'));
		if(!$comp['noesunadmin']){ // SI EL RECEPTOR ES DEL GRUPO ADMINISTRADORES PRINCIPALES SALTAMOS LA COMPROBACIÓN
		
		// COMPROBACIONES DE LA PRIVACIDAD
		$query= db_exec(array(__FILE__, __LINE__), 'query', 'SELECT p_configs FROM u_perfil WHERE user_id = \''.(int)$user_id.'\' LIMIT 1');
        $data = db_exec('fetch_assoc', $query);
        db_exec('free_result', $query);
        $data['p_configs'] = unserialize($data['p_configs']);

		switch($data['p_configs']['rmp']){
        case 0:
		case 8:
		if($data['p_configs']['rmp'] == 0 && !$tsUser->is_admod) {
		return '0: Lo sentimos, pero '.$para.' no permite recibir mensajes';
		}elseif($data['p_configs']['rmp'] == 8 && !$tsUser->is_admod)
		return '0: Lo sentimos, pero '.$para.' no puede utilizar la mensajer&iacute;a privada en estos momentos ';
		break;
		case 1:
		case 2:
		case 3:
		case 4:
		if($comp['mesigue'] == 0 && $comp['lesigo'] == 0) $lesigoomesigue = false; else $lesigoomesigue = true;
		if($comp['mesigue'] == 1 && $comp['lesigo'] == 1) $lesigoymesigue = true; else $lesigoymesigue = false;
		if($data['p_configs']['rmp'] == 1 && !$lesigoymesigue && !$tsUser->is_admod) {
		return '0: Debes seguir a '.$para.' y &eacute;ste debe seguirte para poder enviarle un mensaje.';
		}elseif($data['p_configs']['rmp'] == 2 && !$lesigoomesigue && !$tsUser->is_admod) {
		return '0: Debes seguir a '.$para.' o &eacute;ste debe seguirte para poder enviarle un mensaje.';
		}elseif($data['p_configs']['rmp'] == 3 && !$comp['lesigo'] && !$tsUser->is_admod) {
		return '0: Debes seguir a '.$para.' para poder enviarle un mensaje.';
		}elseif($data['p_configs']['rmp'] == 4 && !$comp['mesigue'] && !$tsUser->is_admod)
		return '0: '.$para.' debe seguirte para que puedas enviarle un mensaje';
		break;
		}
		}

		
			if(db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `u_mensajes` (`mp_to`, `mp_from`, `mp_subject`, `mp_preview`, `mp_date`) VALUES ('.$user_id.', '.$tsUser->uid.', \''.$asunto.'\', \''.$tsCore->setSecure($preview, true).'\',\''.time().'\')')) {

                $mp_id = db_exec('insert_id');
                if(empty($mp_id)) return 'Error al enviar el mensaje.';
                $_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
                if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) { die('0: Su ip no se pudo validar.'); }
				if(db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `u_respuestas` (`mp_id`, `mr_from`, `mr_body`, `mr_ip`, `mr_date`) VALUES (\''.(int)$mp_id.'\', \''.$tsUser->uid.'\', \''.$tsCore->setSecure($mensaje, true).'\',  \''.$_SERVER['REMOTE_ADDR'].'\', \''.time().'\')')) {
                   return 'El mensaje ha sido enviado a <a href="'.$tsCore->settings['url'].'/perfil/'.$para.'">'.$para.'</a>. <br /><br /> <center><a class="btn_g resp" href="'.$tsCore->settings['url'].'/mensajes/leer/'.$mp_id.'">Ver el mensaje enviado</a></center>';
                } else return show_error('Error al ejecutar la consulta de la l&iacute;nea '.__LINE__.' de '.__FILE__.'.', 'db');
            } else return 'Ocurri&oacute; un error. Int&eacute;ntalo nuevamente.';
		} else return 'El usuario no puede recibir nuevos mensajes.';
		} else return 'El usuario no existe. Int&eacute;ntalo nuevamente.';
		} else return 'Debe tener una cuenta activa para realizar esta operaci&oacute;n';

    }
    /*
        newRespuesta()
    */
    function newRespuesta(){
        global $tsCore, $tsUser;
        //
        $mp_id = (int)$_POST['id']; // Fix: 21/02/2014
        $mp_body = substr($_POST['body'],0,1000);
        if(str_replace(array("\n","\t",' '),'',$mp_body) == '') die('0: Debes ingresar tu respuesta.');
        //
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `mp_to`, `mp_from`, `mp_answer` FROM `u_mensajes` WHERE `mp_id` = \'' . (int)$mp_id . '\' '.($tsUser->is_admod ? '' : '&& mp_del_to = \'0\' && mp_del_from = \'0\'').' LIMIT 1');
        $msg = db_exec('fetch_assoc', $query);
        
        // 
        if(!empty($msg)){
			$tsCore->antiFlood(true, 'mps');
            // BLOQUEADO
            if(!$tsUser->is_admod) {
                $block = db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT bid FROM u_bloqueos WHERE (b_user = \''.$msg['mp_to'].'\' && b_auser = \''.$msg['mp_from'].'\') || (b_user = \''.$msg['mp_from'].'\' && b_auser = \''.$msg['mp_to'].'\') LIMIT 1'));
                if($block > 0 || ($tsUser->uid != $msg['mp_from'] && $tsUser->uid != $msg['mp_to'])) die('0: No puedes contestar este mensaje');
            }
            // VISTA PREVIA
            $preview = substr($mp_body,0,75);
            if(db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `u_respuestas` (`mp_id`, `mr_from`, `mr_body`, `mr_ip`, `mr_date`) VALUES (\''.intval($mp_id).'\', \''.$tsUser->uid.'\', \''.$tsCore->setSecure($mp_body, true).'\', \''.$_SERVER['REMOTE_ADDR'].'\', \''.time().'\')')){
            // CUANDO RESPONDA EL DESTINATARIO...
                if($msg['mp_from'] != $tsUser->uid){
                    if($msg['mp_answer'] == 0) $update = ', mp_answer = 1';
                    $update .= ', mp_read_to = 1, mp_read_mon_to = 2';
                    $update .= ', mp_read_from = 0, mp_read_mon_from = 0';
                    $update .= ', mp_del_from = 0';
                }
                else {
                    $update .= ', mp_read_to = 0, mp_read_mon_to = 0';
                    $update .= ', mp_read_from = 1, mp_read_mon_from = 2';
                    $update .= ', mp_del_to = 0';
                }
                // ACTUALIZAMOS EL MENSAJE
                db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `u_mensajes` SET `mp_preview` = \''.$tsCore->setSecure($preview, true).'\', `mp_date` = \''.time().'\' '.$update.' WHERE `mp_id` = \''.(int)$mp_id.'\'');
                //
                $return['mp_date'] = time();
				$return['mp_ip'] = $_SERVER['REMOTE_ADDR'];
                $return['mp_body'] = $tsCore->parseBadWords($tsCore->parseSmiles($tsCore->parseBBCode($mp_body)), true);
                //
                return $return;
            }
        } else return die('0: El mensaje no existe.');
    }
    /*
        getMensajes($type)
        :: FALTA LA PAGINACION :/
    */
    function getMensajes($type = 1, $unread = false, $where = 'normal'){
		global $tsCore, $tsUser;
		// MONITOR DE MENSAJES SOLO SI HAY MAS  DE 5 NUEVOS
        if($type == 1) {
            // SI HAY MAS DE 5 MENSAJES NUEVOS SOLO LEEMOS LOS NUEVOS
            if($this->mensajes > 0 || $unread == true) {
                $funread = "AND mp_read_mon_to ".($where != 'live' ? '< 2' : '= 0');
                $sunread = "AND mp_read_mon_from ".($where != 'live' ? '< 2' : '= 0');
                $limit = "";
            } else {
                $limit = "LIMIT 5";
            }
            $sql = 'SELECT mp_id, mp_to, mp_from, mp_read_to, mp_read_mon_to, mp_subject, mp_preview, mp_date, user_name FROM u_mensajes AS m LEFT JOIN u_miembros AS u ON mp_from = user_id WHERE mp_to = '.$tsUser->uid.' AND mp_del_to = 0 '.$funread.' UNION (SELECT mp_id, mp_to, mp_from, mp_read_from, mp_read_mon_from, mp_subject, mp_preview, mp_date, user_name user_name FROM u_mensajes AS m LEFT JOIN u_miembros AS u ON mp_to = user_id WHERE mp_from = '.$tsUser->uid.' AND mp_del_from = 0 AND mp_answer = 1 '.$sunread.') ORDER BY mp_id DESC '.$limit.'';
			// CONSULTA
            $query = db_exec(array(__FILE__, __LINE__), 'query', $sql);
            $data['total'] = 0;
            while($row = db_exec('fetch_assoc', $query)){
                $row['mp_from'] = ($row['mp_from'] == $tsUser->uid) ? $row['mp_to'] : $row['mp_from'];
                $data['data'][$row['mp_date']] = $row;
                // AHORA ACTUALIZAMOS PARA QUE NO SE VUELVAN A NOTIFICAR EN EL MONITOR
                if($tsUser->uid == $row['mp_to']) $update = 'mp_read_mon_to = '.($where == 'live' ? '1' : '2');
                else $update = 'mp_read_mon_from = '.($where == 'live' ? '1' : '2');
                db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `u_mensajes` SET '.$update.' WHERE mp_id  = \''.(int)$row['mp_id'].'\'');
                //
                $data['total']++;
            }
			
        // RECIBIDOS
		} elseif($type == 2){
            // MOSTRAR LOS NO LEÍDOS (Fix: 21/02/2014)
            if($unread == true){
                $funread = 'AND mp_read_to = 0';
                $sunread = 'AND mp_read_from = 0';
            }
            // CONSULTA
            $sql = 'SELECT mp_id, mp_to, mp_from, mp_read_to, mp_subject, mp_preview, mp_date, user_name FROM `u_mensajes` AS m LEFT JOIN `u_miembros` AS u ON mp_from = user_id WHERE mp_to = '.$tsUser->uid.' AND mp_del_to = 0 '.$funread.' UNION (SELECT mp_id, mp_to, mp_from, mp_read_from, mp_subject, mp_preview, mp_date, user_name user_name FROM u_mensajes AS m LEFT JOIN u_miembros AS u ON mp_to = user_id WHERE mp_from = '.$tsUser->uid.' AND mp_del_from = 0 AND mp_answer = 1 '.$sunread.') ORDER BY mp_id DESC';
            // PAGINAR
            $total = db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', $sql));
            $pages = $tsCore->getPagination($total, 12);
            $data['pages'] = $pages;
			// CONSULTA
			$query = db_exec(array(__FILE__, __LINE__), 'query', $sql.' LIMIT '.$pages['limit']);
            while($row = db_exec('fetch_assoc', $query)){
                // PARA SABER SI ES RESPUESTA O MENSAJE NORMAL
                $row['mp_type'] = ($row['mp_from'] != $tsUser->uid) ? 1 : 2;
                $row['mp_from'] = ($row['mp_from'] == $tsUser->uid) ? $row['mp_to'] : $row['mp_from'];
                $data['data'][$row['mp_date']] = $row;
            }
			
        // ENVIADOS POR MI
		}elseif($type == 3){
            $sql = 'SELECT m.mp_id, m.mp_to, m.mp_read_to, m.mp_subject, m.mp_preview, m.mp_date, u.user_name FROM `u_mensajes` AS m LEFT JOIN `u_miembros` AS u ON m.mp_to = u.user_id WHERE m.mp_from = '.$tsUser->uid.' ORDER BY m.mp_id DESC';
            // PAGINAR
            $total = db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', $sql));
            $pages = $tsCore->getPagination($total, 12);
            $data['pages'] = $pages;
			// CONSULTA
			$query = db_exec(array(__FILE__, __LINE__), 'query', $sql.' LIMIT '.$pages['limit']);
            while($row = db_exec('fetch_assoc', $query)){
                $row['mp_type'] = 2;
                $row['mp_from'] = $row['mp_to'];
                $row['mp_read_to'] = 1;
                $data['data'][$row['mp_date']] = $row;
            }
			
        // RESPONDIDOS POR MI
		}elseif($type == 4){
            $sql = 'SELECT m.mp_id, m.mp_from, m.mp_read_from, m.mp_subject, m.mp_preview, m.mp_date, u.user_name FROM `u_mensajes` AS m LEFT JOIN `u_miembros` AS u ON m.mp_from = u.user_id WHERE m.mp_to = '.$tsUser->uid.' AND m.mp_answer = 1 ORDER BY m.mp_id DESC';
            // PAGINAR
            $total = db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', $sql));
            $pages = $tsCore->getPagination($total, 12);
            $data['pages'] = $pages;
			// CONSULTA
			$query = db_exec(array(__FILE__, __LINE__), 'query', $sql.' LIMIT '.$pages['limit']);
            while($row = db_exec('fetch_assoc', $query)){
                $row['mp_type'] = 1;
                $row['mp_read_to'] = 1;
                $data['data'][$row['mp_date']] = $row;
            }
			
		// BUSCADOR
		} elseif($type == 5){
            // CONSULTA
            $sql = 'SELECT mp_id, mp_to, mp_from, mp_read_to, mp_subject, mp_preview, mp_date, user_name FROM `u_mensajes` AS m LEFT JOIN `u_miembros` AS u ON mp_from = user_id WHERE mp_to = '.$tsUser->uid.' AND mp_del_to = \'0\' AND `mp_subject` LIKE \'%'.$tsCore->setSecure($_GET['qm']).'%\'  UNION (SELECT mp_id, mp_to, mp_from, mp_read_from, mp_subject, mp_preview, mp_date, user_name user_name FROM u_mensajes AS m LEFT JOIN u_miembros AS u ON mp_to = user_id WHERE mp_from = '.$tsUser->uid.' AND mp_del_from = \'0\' AND mp_answer = 1) ORDER BY mp_id DESC';
            // PAGINAR
            $total = db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', $sql));
            $pages = $tsCore->getPagination($total, 12);
            $data['pages'] = $pages;
			// CONSULTA
			$query = db_exec(array(__FILE__, __LINE__), 'query', $sql.' LIMIT '.$pages['limit']);
            while($row = db_exec('fetch_assoc', $query)){
                // PARA SABER SI ES RESPUESTA O MENSAJE NORMAL
                $row['mp_type'] = ($row['mp_from'] != $tsUser->uid) ? 1 : 2;
                $row['mp_from'] = ($row['mp_from'] == $tsUser->uid) ? $row['mp_to'] : $row['mp_from'];
                $data['data'][$row['mp_date']] = $row;
            }
			
			$data['texto']= $_GET['qm'];
		}
        // ORDENAR Y RETORNAR
        krsort($data['data']);
        return $data;
    }
    /*
        readMensaje()
    */
    function readMensaje(){
        global $tsCore, $tsUser;
        //
        if(!ctype_digit($_GET['id'])){
          die('No existe ning&uacute;n mensaje as&iacute; mijo ._.');
        }
        $mp_id = intval($_GET['id']);
        //
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT m.*, u.user_name FROM `u_mensajes` AS m LEFT JOIN `u_miembros` AS u ON m.mp_from = u.user_id WHERE m.mp_id = \'' . $mp_id . '\' '.($tsUser->is_admod ? '' : '&& ((m.mp_to = \'' . $tsUser->uid . '\' && m.mp_del_to = 0) || (m.mp_from = \'' . $tsUser->uid . '\' && m.mp_del_from = 0))').' LIMIT 1');
        if (db_exec('num_rows', $query)) { $data = db_exec('fetch_assoc', $query); } else { $tsCore->redirectTo($tsCore->settings['url'] . '/mensajes/'); } 
		
        // NO PUEDE LEER MENSAJES DE OTROS USUARIOS NI RESPUESTAS POR SEPARADO, SI SOY MODERADOR NO PUEDO LEER MENSAJES A MENOS QUE ESTÉN REPORTADOS Y SI SOY ADMINISTRADOR LOS VEO TODOS :B
	    if(db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT obj_id FROM `w_denuncias` WHERE obj_id = \''.(int)$mp_id.'\' && `d_type` = \'2\' LIMIT 1')) && $tsUser->is_admod){ $canview = true; }else{ $canview = false; }
        // REDIRIGIR SI NO TIENE PERMISO
        if($data['mp_to'] != $tsUser->uid && $data['mp_from'] != $tsUser->uid && !$canview && $tsUser->is_admod != 1) $tsCore->redirectTo($tsCore->settings['url'].'/mensajes/');
        
        // MENSAJE
        $history['msg'] = $data;
        // RESPUESTAS
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT r.*, u.user_name FROM u_respuestas AS r LEFT JOIN u_miembros AS u ON r.mr_from = u.user_id WHERE r.mp_id = \''.intval($mp_id).'\' ORDER BY mr_id');
		//$history['res'] = result_array($query);
        while($row = db_exec('fetch_assoc', $query)){
        $row['mr_body'] = $tsCore->parseBadWords($tsCore->parseSmiles($tsCore->parseBBCode($row['mr_body'])), true);
            $history['res'][] = $row;
        }
		
        // ACTUALIZAR
        $resp = count($history['res']);
        $from = $history['res'][$resp-1]['mr_from']; // ULTIMO EN RESPONDER
        //
        if($tsUser->uid == $data['mp_to']) {$update = 'mp_read_to = 1, mp_read_mon_to = 2'; $history['msg']['mp_type'] = 1;} // PARA MI
        elseif($from == $data['mp_to'] && $data['mp_from'] == $tsUser->uid) {$update = 'mp_read_from = 1, mp_read_mon_from = 2'; $history['msg']['mp_type'] = 2;} // ME RESPONDIERON
        elseif($from == $data['mp_from']) {$update = 'mp_read_from = 1, mp_read_mon_from = 2'; $history['msg']['mp_type'] = 2;}
        //
		// LEIDO
		if(isset($update)) db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `u_mensajes` SET '.$update.' WHERE `mp_id` = \''.intval($mp_id).'\''); // Fix: 27/02/2014

		// BLOQUEADO
        $user_id = ($data['mp_from'] != $tsUser->uid) ? $data['mp_from'] : $data['mp_to'];
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT bid AS block FROM `u_bloqueos` WHERE b_user = '.$tsUser->uid.' AND b_auser = \''.intval($user_id).'\' LIMIT 1');
        // PUEDO RESPONDER o estoy bloqueado?
        $history['ext']['can_read'] = (!$tsUser->is_admod && db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT bid FROM u_bloqueos WHERE (b_user = \''.$data['mp_to'].'\' && b_auser = \''.$data['mp_from'].'\') || (b_user = \''.$data['mp_from'].'\' && b_auser = \''.$data['mp_to'].'\') LIMIT 1')) > 0) ? 0 : 1;
        
        $history['ext']['uid'] = $user_id;
        $history['ext']['user'] = $tsUser->getUserName($user_id);
        //
        return $history;
    }

    /*
        editMensajes();
    */
    function editMensajes(){
        global $tsCore, $tsUser;
        //
        $ids = explode(',',$tsCore->setSecure($_POST['ids']));
        // ARMAR IDS
        foreach($ids as $nid){
            $id = explode(':',$nid);
            $nids[$id[1]][] = $id[0];
        }
        if(empty($nids)) return false;
        $act = htmlspecialchars($_POST['act']);
        // HMM SI NO LE ENTIENDES A ESTO NTP YO TAMPOCO xD PERO FUNCIONA :D
        switch($act) {
            case 'read':
                db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_mensajes SET mp_read_to = 1, mp_read_mon_to = 2 WHERE mp_id IN('.implode(',',$nids[1]).') AND mp_to = \''.$tsUser->uid.'\' LIMIT 1');
                db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_mensajes SET mp_read_from = 1, mp_read_mon_from = 2 WHERE mp_id IN('.implode(',',$nids[2]).') AND mp_from = \''.$tsUser->uid.'\' LIMIT 1');
            break;
            case 'unread':
                db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_mensajes SET mp_read_to = 0, mp_read_mon_to = 1 WHERE mp_id IN('.implode(",",$nids[1]).') AND mp_to = \''.$tsUser->uid.'\' LIMIT 1');
                db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_mensajes SET mp_read_from = 0, mp_read_mon_from = 1 WHERE mp_id IN('.implode(",",$nids[2]).') AND mp_from = \''.$tsUser->uid.'\' LIMIT 1');
            break;
            case 'delete':
                db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_mensajes SET mp_del_to = 1 WHERE mp_id IN('.implode(",",$nids[1]).') AND mp_to = \''.$tsUser->uid.'\' LIMIT 1');
                db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_mensajes SET mp_del_from = 1 WHERE mp_id IN('.implode(",",$nids[2]).') AND mp_from = \''.$tsUser->uid.'\' LIMIT 1');
                // BORRAMOS SOLO SI LOS DOS LO HAN DECIDIDO :D
                $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `mp_id`, `mp_del_to` = 1 AND `mp_del_from` = 1 AND (mp_to =  \''.$tsUser->uid.'\' OR `mp_from` =  \''.$tsUser->uid.'\')');
                    while($row = db_exec('fetch_assoc', $query)){
                        if(db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM `u_mensajes` WHERE `mp_id` =  \''.$row['mp_id'].'\'')) {
                            db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM `u_respuestas` WHERE `mp_id` = \''.$row['mp_id'].'\'');
                        }
                    }
                    //
            break;
        }
    }
}