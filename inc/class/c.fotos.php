<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Modelo para el control de las fotos
 *
 * @name    c.fotos.php
 * @author  PHPost Team
 */
class tsFotos {

	// INSTANCIA DE LA CLASE
	public static function &getInstance(){
		static $instance;
		
		if( is_null($instance) ){
			$instance = new tsFotos();
    	}
		return $instance;
	}
	
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*\
								PUBLICAR FOTOS
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*
		newFoto()
	*/
	function newFoto(){
		global $tsCore, $tsUser, $tsMonitor, $tsActividad;
		//
		if($tsUser->is_member && $tsUser->info['user_baneado'] == 0 && $tsUser->info['user_activo'] == 1 && ($tsUser->is_admod || $tsUser->permisos['gopf'])) {
		
	
		$fData = array(
            'titulo' => $tsCore->setSecure($tsCore->parseBadWords($_POST['titulo']), true),
            'foto' => array('url' => $tsCore->setSecure($tsCore->parseBadWords($_POST['url'])), 'file' => $_FILES['file']),
            'desc' => $tsCore->setSecure($tsCore->parseBadWords(substr($_POST['desc'], 0, 1500)), true),
            'closed' => empty($_POST['closed']) ? 0 : 1,
			'visitas' => empty($_POST['visitas']) ? 0 : 1,
        );
		
		$antiflood = $tsUser->permisos['goaf']*5;
        $q1 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(foto_id) AS f FROM `f_fotos` WHERE (f_date > \''.(time()-$antiflood).'\' && f_user = \''.$tsUser->uid.'\') OR (f_url = \''.$fData['foto']['url'].'\' OR (f_title = \''.$fData['titulo'].'\' && f_date > \''.(time()-$antiflood*12).'\' && f_user = \''.$tsUser->uid.'\') ) LIMIT 1'));
        if($q1[0]) die('Espere '.$antiflood.' segundos para continuar. Error [#0aF2]'); 
        // COMPROBAR CAMPOS
        if(empty($fData['titulo'])) $error['titulo'] = 'true';
        // SE PERMITE SUBIDA DE ARCHIVOS?
        if($tsCore->settings['c_allow_upload'] == 1){
            if(empty($fData['foto']['url']) && empty($fData['foto']['file']['name'])) return 'No has seleccionado ningun archivo.';
        } else {
            if(empty($fData['foto']['url'])) return 'No has ingresado ninguna URL.';
        }
        	
        // ANTI FLOOD original (?)
        $tsCore->antiFlood(true, 'foto', 'Para el carro, chacho...');
        // UPLOAD
        require('c.upload.php');
        $tsUpload =& tsUpload::getInstance();
        $tsUpload->image_scale = true;
        // HACER        
        if($tsCore->settings['c_allow_upload'] == 1 && $fData['foto']['file']['name'] != '') $result = $tsUpload->newUpload(1);
        else {
            $tsUpload->file_url = $fData['foto']['url'];
            $result = $tsUpload->newUpload(2);
        }
        //
        if($result[0][0] == 0) return $result[0][1];
        else{
            $img_url = $result[0][1];
            if(empty($img_url)) return 'Lo sentimos ocurri&oacute; un error al subir la imagen.';

			// INSERTAMOS
			db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `f_fotos` SET f_last = \'0\' WHERE f_user = '.$tsUser->uid.' AND f_last = 1'); // LA ULTIMA DEJA DE SERLO
            $_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
            if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) { die('0: Su ip no se pudo validar.'); }
			if(db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `f_fotos` (f_title, f_date, f_description, f_url, f_user, f_closed, f_visitas, f_last, f_ip) VALUES (\''.$fData['titulo'].'\', \''.time().'\', \''.$fData['desc'].'\',  \''.$img_url.'\', \''.$tsUser->uid.'\', \''.$fData['closed'].'\', \''.$fData['visitas'].'\', \'1\', \''.$_SERVER['REMOTE_ADDR'].'\')')) {
                $fid = db_exec('insert_id');
                // Estadísticas
                db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `w_stats` SET `stats_fotos` = stats_fotos + \'1\' WHERE `stats_no` = \'1\'');
                //db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `u_miembros` SET `user_fotos` = user_fotos + \'1\' WHERE `user_id` = \''.$tsUser->uid.'\''); // Eliminado en 1.1.000.9
				// AGREGAR AL MONITOR DE LOS USUARIOS QUE ME SIGUEN
				$tsMonitor->setFollowNotificacion(10, 1, $tsUser->uid, $fid);
                // ACTIVIDAD
                $tsActividad->setActividad(9, $fid);
                //
                return $fid;
            }
            else exit( show_error('Error al ejecutar la consulta de la l&iacute;nea '.__LINE__.' de '.__FILE__.'.', 'db') );
       // } else return 'fewlolazsp';       
        }
        
		}else return 'No tienes permiso para continuar.';
		
	}
    /*
        getFotoEdit()
    */
    function getFotoEdit(){
        global $tsCore, $tsUser;
        //
        $fid = $tsCore->setSecure($_GET['id']);
        // DATOS
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT * FROM `f_fotos` WHERE foto_id = \''.(int)$fid.'\' LIMIT 1');
        $data = db_exec('fetch_assoc', $query);
        
        //
        if(!empty($data['f_user'])){
            // ES EL DUEÑO DE LA FOTO?
            if($data['f_user'] == $tsUser->uid || $tsUser->is_admod || $tsUser->permisos['moedfo']){
                return $data;
            } else return 'La foto que intentas editar no es tuya.';
        } else return 'La foto que intentas editar no existe.';
    }
    /*
        editFoto()
    */
    function editFoto(){
        global $tsCore, $tsUser, $tsMonitor;
        //
        $fid = (int)$_GET['id'];
        // DATOS
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT f.foto_id, f.f_title, f.f_user, u.user_name FROM f_fotos AS f LEFT JOIN u_miembros AS u ON f.f_user = u.user_id WHERE f.foto_id = \''.(int)$fid.'\' LIMIT 1');
        $data = db_exec('fetch_assoc', $query);
        
        //
        if(!empty($data['f_user'])){
            // ES EL DUEÑO DE LA FOTO?
            if($data['f_user'] == $tsUser->uid || $tsUser->is_admod || $tsUser->permisos['moedfo']){
        		$fData = array(
                    'titulo' => $tsCore->setSecure($tsCore->parseBadWords($_POST['titulo']), true),
                    'desc' => $tsCore->setSecure($tsCore->parseBadWords(substr($_POST['desc'], 0, 1500)), true),
                    'privada' => empty($_POST['privada']) ? 0 : 1,
                    'closed' => empty($_POST['closed']) ? 0 : 1,
					'visitas' => empty($_POST['visitas']) ? 0 : 1,
					'razon' => empty($_POST['razon']) ? 'undefined' : $tsCore->setSecure($_POST['razon'], true),
                );
                // UPDATES
				db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `f_fotos` SET f_title = \''.$fData['titulo'].'\', f_description = \''.$fData['desc'].'\',  f_closed = \''.$fData['closed'].'\', f_visitas = \''.$fData['visitas'].'\' WHERE foto_id = \''.(int)$fid.'\'');
				
				if($data['f_user'] != $tsUser->uid){
				    $aviso = 'Hola <b>'.$tsUser->getUserName($data['f_user'])."</b>\n\n Te informo que tu foto <a href=".$tsCore->settings['url'].'/fotos/'.$data['user_name'].'/'.$data['foto_id'].'/'.$tsCore->setSEO($data['f_title']).'.html'."><b>".$data['f_title']."</b></a> ha sido editada por <a href=\"#\" class=\"hovercard\" uid=\"".$tsUser->uid."\">".$tsUser->nick."</a>\n\n Causa: <b>".$fData['razon']."</b>\n\n \n\n Te recomendamos leer el <a href=\"".$tsCore->settings['url']."/pages/protocolo/\">protocolo</a> para evitar futuras sanciones.\n\n Muchas gracias por entender!";
                    $tsMonitor->setAviso($data['f_user'], 'Foto editada', $aviso, 2);
				    $_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
				    if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) { die('Su ip no se pudo validar.'); }
				    db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `w_historial` (`pofid`, `action`, `type`, `mod`, `reason`, `date`, `mod_ip`) VALUES (\''.(int)$data['foto_id'].'\', \'1\', \'2\', \''.$tsUser->uid.'\', \''.$fData['razon'].'\', \''.time().'\', \''.$tsCore->setSecure($_SERVER['REMOTE_ADDR']).'\')');
				}
				// REDIRIGIMOS
                $url = $tsCore->settings['url'].'/fotos/'.$data['user_name'].'/'.$fid.'/'.$tsCore->setSEO($fData['titulo']).'.html';
                //
                $tsCore->redirectTo($url);
            } else return 'La foto que intentas editar no es tuya.';
        } else return 'La foto que intentas editar no existe.';
    }
    /*
        delFoto()
    */
    function delFoto(){
        global $tsCore, $tsUser;
        //
        $fid = $tsCore->setSecure($_POST['fid']);
        // DATOS
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `f_user` FROM `f_fotos` WHERE foto_id = \''.(int)$fid.'\' LIMIT 1');
        $data = db_exec('fetch_assoc', $query);
        
        //
        if(!empty($data['f_user'])){
            // ES EL DUEÑO DE LA FOTO?
            if($data['f_user'] == $tsUser->uid || $tsUser->is_admod || $tsUser->permisos['moef']){
			    if(db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM f_fotos WHERE foto_id = \''.(int)$fid.'\'')){
                    // BORRAMOS LOS COMENTARIOS
					db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM `f_comentarios` WHERE c_foto_id = \''.(int)$fid.'\'');
                    // RESTAMOS ESTADÍSTICAS
                    db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `w_stats` SET `stats_fotos` = stats_fotos - \'1\' WHERE `stats_no` = \'1\'');
                    return '1: OK';
                } else return '0: Ocurri&oacute; un error al intentar borrar';
            } else return '0: Esta no es tu foto.';
        } else return '0: La foto no existe.';
    }
    /*
        getLastFotos()
    */
    function getLastFotos(){
        global $tsCore, $tsUser;
        //
		$max = 10; // MAXIMO A MOSTRAR
		$limit = $tsCore->setPageLimit($max, true);		
		// PAGINAS
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(f.foto_id) FROM f_fotos AS f LEFT JOIN u_miembros AS u ON u.user_id = f.f_user '.($tsUser->is_admod && $tsCore->settings['c_see_mod'] == 1 ? '' : 'WHERE f.f_status = \'0\' AND u.user_activo = \'1\' && u.user_baneado = \'0\''));
		list ($total) = db_exec('fetch_row', $query);
		
		$data['pages'] = $tsCore->pageIndex($tsCore->settings['url']."/fotos/?",$_GET['s'],$total, $max);
        //
		$query = 'SELECT f.foto_id, f.f_title, f.f_date, f.f_description, f.f_url, f.f_status, u.user_name, u.user_activo, u.user_baneado FROM f_fotos AS f LEFT JOIN u_miembros AS u ON u.user_id = f.f_user '.($tsUser->is_admod && $tsCore->settings['c_see_mod'] == 1 ? '' : 'WHERE f.f_status = \'0\' AND u.user_activo = \'1\' && u.user_baneado = \'0\'').' ORDER BY f.foto_id DESC LIMIT '.$limit;
        $data['data'] = result_array(db_exec(array(__FILE__, __LINE__), 'query', $query));
        
		
        //
        return $data;
    }
    /*
        getLastComments()
    */
    function getLastComments(){
        global $tsUser, $tsCore;
        //
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT c.cid, c.c_user, f.foto_id, f.f_title, f.f_status, u.user_name, u.user_activo FROM f_comentarios AS c LEFT JOIN f_fotos AS f ON c.c_foto_id = f.foto_id LEFT JOIN u_miembros AS u ON f.f_user = u.user_id '.($tsUser->is_admod && $tsCore->settings['c_see_mod'] == 1 ? '' : 'WHERE f.f_status = \'0\' && u.user_activo = \'1\' && u.user_baneado = \'0\'').' ORDER BY c.c_date DESC LIMIT 10');
        $data = result_array($query);
        
        //
        return $data;
    }
    /*
        getFotos($user_id)
    */
    function getFotos($user_id){
        global $tsCore, $tsUser;
        //
        $query = 'SELECT f.foto_id, f.f_title, f.f_date, f.f_description, f.f_url, f.f_status, u.user_name, u.user_activo FROM f_fotos AS f LEFT JOIN u_miembros AS u ON u.user_id = f.f_user WHERE f.f_user = \''.(int)$user_id.'\' '.($tsUser->is_admod && $tsCore->settings['c_see_mod'] == 1 ? '' : ' && f.f_status = \'0\' && u.user_activo = \'1\' && u.user_baneado = \'0\'').' ORDER BY f.foto_id DESC';
        // PAGINAR
        $total = db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', $query));
        $pages = $tsCore->getPagination($total, 12);
        $data['pages'] = $pages;
        //
        $data['data'] = result_array(db_exec(array(__FILE__, __LINE__), 'query', $query.' LIMIT '.$pages['limit']));
        
        //
        return $data;
    }
    /*
        getFoto()
    */
    function getFoto(){
        global $tsCore, $tsUser;
        //
        $fid = intval($_GET['fid']);
        // MORE FOTOS
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT f.*, u.user_name, u.user_activo, p.user_pais, p.user_sexo, u.user_rango, r.r_name, r.r_color, r.r_image FROM f_fotos AS f LEFT JOIN u_miembros AS u ON u.user_id = f.f_user LEFT JOIN u_perfil AS p ON p.user_id = u.user_id LEFT JOIN u_rangos AS r ON u.user_rango = r.rango_id WHERE f.foto_id = \''.(int)$fid.'\' '.($tsUser->is_admod || $tsUser->permisos['moacp'] ? '' : 'AND f.f_status = \'0\' AND u.user_activo = \'1\'').' LIMIT 1');
        $data['foto'] = db_exec('fetch_assoc', $query);
        
        $q1 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(cid) AS cf FROM f_comentarios WHERE c_user = \''.$data['foto']['f_user'].'\''));
		$q2 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(foto_id) AS f FROM f_fotos WHERE f_user = \''.$data['foto']['f_user'].'\' && f_status = \'0\''));
        $data['foto']['user_foto_comments'] = $q1[0];
        $data['foto']['user_fotos'] = $q2[0];
		$data['foto']['exist'] = db_exec('num_rows', $query);
        $data['foto']['f_description'] = $tsCore->parseSmiles($data['foto']['f_description']);
        
        include('../ext/datos.php');
        $pais = $data['foto']['user_pais'];
        $data['foto']['user_pais'] = array($pais, $tsPaises[$pais]);
        // FOLLOW
		$data['foto']['follow'] = db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT `follow_id` FROM `u_follows` WHERE f_user = \''.$tsUser->uid.'\' AND f_id = \''.(int)$data['foto']['f_user'].'\' AND f_type = \'1\' LIMIT 1'));
        
        // SEGUIDORES
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT f.f_id, p.foto_id, p.f_title, p.f_url, u.user_name FROM u_follows AS f LEFT JOIN f_fotos AS p ON f.f_id = p.f_user LEFT JOIN u_miembros AS u ON p.f_user = u.user_id WHERE f.f_user = \''.$data['foto']['f_user'].'\' AND f.f_type = \'1\' AND p.f_last = \'1\' LIMIT 5');
        $data['amigos'] = result_array($query);
        
        // ULTIMAS FOTOS
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT f.foto_id, f.f_title, f.f_date, f.f_status, f.f_url, u.user_name, u.user_activo FROM f_fotos AS f LEFT JOIN u_miembros AS u ON u.user_id = f.f_user WHERE f.f_user = \''.$data['foto']['f_user'].'\' '.($tsUser->is_admod && $tsCore->settings['c_see_mod'] == 1 ? '' : 'AND f.f_status = \'0\' AND u.user_activo = \'1\' && u.user_baneado = \'0\'').' ORDER BY f.foto_id DESC LIMIT 5');
        $data['last'] = result_array($query);
        
        // COMENTARIOS
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT c.*, u.user_name, u.user_activo FROM f_comentarios AS c LEFT JOIN u_miembros AS u ON c.c_user = u.user_id WHERE c.c_foto_id = \''.(int)$fid.'\' '.($tsUser->is_admod && $tsCore->settings['c_see_mod'] == 1 ? '' : 'AND u.user_activo = \'1\' && u.user_baneado = \'0\''));
        $comments = result_array($query);
        foreach($comments as $key => $val){
            $val['c_body'] = $tsCore->parseBadWords($tsCore->parseSmiles($val['c_body']), true);
            $data['comments'][] = $val;
        }
        $data['foto']['f_comments'] = count($comments);
        
		// MEDALLAS
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT m.*, a.* FROM w_medallas AS m LEFT JOIN w_medallas_assign AS a ON a.medal_id = m.medal_id WHERE a.medal_for = \''.(int)$fid.'\' AND m.m_type = \'3\' ORDER BY a.medal_date DESC LIMIT 10');
		$data['medallas'] = result_array($query);
        $data['m_total'] = count($data['medallas']);
        
		//VISITANTES RECIENTES
		if($data['foto']['f_visitas']){
		$data['visitas'] = result_array(db_exec(array(__FILE__, __LINE__), 'query', 'SELECT v.*, u.user_id, u.user_name FROM w_visitas AS v LEFT JOIN u_miembros AS u ON v.user = u.user_id WHERE v.for = \''.(int)$fid.'\' && v.type = \'3\' && v.user > 0 ORDER BY v.date DESC LIMIT 15'));
		}
        // UPDATES
		$visitado = db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT id FROM `w_visitas` WHERE `for` = \''.(int)$fid.'\' && `type` = \'3\' && '.($tsUser->is_member ? '(`user` = \''.$tsUser->uid.'\' OR `ip` LIKE \''.$_SERVER['REMOTE_ADDR'].'\')' : '`ip` LIKE \''.$_SERVER['REMOTE_ADDR'].'\'').' LIMIT 0,100'));
		if($tsUser->is_member && $visitado == 0) {
			db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO w_visitas (`user`, `for`, `type`, `date`, `ip`) VALUES (\''.$tsUser->uid.'\', \''.(int)$fid.'\', \'3\', \''.time().'\', \''.$_SERVER['REMOTE_ADDR'].'\')');
			db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE f_fotos SET f_hits = f_hits + 1 WHERE foto_id = \''.(int)$fid.'\' AND f_user != \''.$tsUser->uid.'\'');		
		}else{
		db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `w_visitas` SET `date` = \''.time().'\', ip = \''.$_SERVER['REMOTE_ADDR'].'\' WHERE `for` = \''.(int)$post_id.'\' && `type` = \'3\'');
		}
		if($tsCore->settings['c_hits_guest'] == 1 && !$tsUser->is_member && !$visitado) {
			db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO w_visitas (`user`, `for`, `type`, `date`, `ip`) VALUES (\'0\', \''.(int)$fid.'\', \'3\', \''.time().'\', \''.$_SERVER['REMOTE_ADDR'].'\')');
			db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE f_fotos SET f_hits = f_hits + 1 WHERE foto_id = \''.(int)$fid.'\'');
		}
		//
		$this->DarMedalla($fid);
		//
        return $data;
    }
	
	/*
		DarMedalla()
	*/
	function DarMedalla($fid){
		//
		$data = db_exec('fetch_assoc', $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT foto_id, f_user, f_votos_pos, f_votos_neg, f_hits FROM f_fotos WHERE foto_id = \''.(int)$fid.'\' LIMIT 1'));
		//
        $q1 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(cid) AS a FROM f_comentarios WHERE c_foto_id = \''.(int)$fid.'\''));
        $q2 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(wm.medal_id) AS m FROM w_medallas AS wm LEFT JOIN w_medallas_assign AS wma ON wm.medal_id = wma.medal_id WHERE wm.m_type = \'3\' AND wma.medal_for = \''.(int)$fid.'\''));
		// MEDALLAS
		$datamedal = result_array($query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT * FROM w_medallas WHERE m_type = \'3\' ORDER BY m_cant DESC'));
		
		//		
		foreach($datamedal as $medalla){
			// DarMedalla
			if($medalla['m_cond_foto'] == 1 && !empty($data['f_votos_pos']) && $medalla['m_cant'] > 0 && $medalla['m_cant'] <= $data['f_votos_pos']){
				$newmedalla = $medalla['medal_id'];
			}elseif($medalla['m_cond_foto'] == 2 && !empty($data['f_votos_neg']) && $medalla['m_cant'] > 0 && $medalla['m_cant'] <= $data['f_votos_neg']){
				$newmedalla = $medalla['medal_id'];
			}elseif($medalla['m_cond_foto'] == 3 && !empty($q1[0]) && $medalla['m_cant'] > 0 && $medalla['m_cant'] <= $q1[0]){
				$newmedalla = $medalla['medal_id'];
			}elseif($medalla['m_cond_foto'] == 4 && !empty($data['f_hits']) && $medalla['m_cant'] > 0 && $medalla['m_cant'] <= $data['f_hits']){
				$newmedalla = $medalla['medal_id'];
			}elseif($medalla['m_cond_foto'] == 5 && !empty($q2[0]) && $medalla['m_cant'] > 0 && $medalla['m_cant'] <= $q2[0]){
				$newmedalla = $medalla['medal_id'];
			}
		//SI HAY NUEVA MEDALLA, HACEMOS LAS CONSULTAS
		if(!empty($newmedalla)){
		  $q3 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(id) AS w FROM w_medallas_assign WHERE medal_id = \''.(int)$newmedalla.'\' AND medal_for = \''.(int)$fid.'\''));
		if(!$q3[0]){
		db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `w_medallas_assign` (`medal_id`, `medal_for`, `medal_date`, `medal_ip`) VALUES (\''.(int)$newmedalla.'\', \''.(int)$fid.'\', \''.time().'\', \''.$_SERVER['REMOTE_ADDR'].'\')');
		db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO u_monitor (user_id, obj_uno, obj_dos, not_type, not_date) VALUES (\''.(int)$data['f_user'].'\', \''.(int)$newmedalla.'\', \''.(int)$fid.'\', \'17\', \''.time().'\')');
		db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE w_medallas SET m_total = m_total + 1 WHERE medal_id = \''.(int)$newmedalla.'\'');}
		}
	  }	
	}
    /*
        votarFoto()
    */
    function votarFoto(){
        global $tsCore, $tsUser;
        // SOLO MIEMBROS
		if($tsUser->is_member){
			// VOTAR
			$fid = $tsCore->setSecure($_POST['fotoid']);
			$voto = $tsCore->setSecure($_POST['voto']);
			
			if($voto == 'pos'){
			 $voto = 'f_votos_pos = f_votos_pos + 1';
             $type = 0;
			}else{
			 $voto = 'f_votos_neg = f_votos_neg + 1';
             $type = 1;
			}
            //
			$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT f_user FROM f_fotos WHERE foto_id = \''.(int)$fid.'\' LIMIT 1');
			$data = db_exec('fetch_assoc', $query);
			
			// ES MI COMENTARIO?
			$is_mypost = ($data['f_user'] == $tsUser->uid) ? true : false;
			// NO ES MI COMENTARIO, PUEDO VOTAR
			if(!$is_mypost){
				// YA LO VOTE?
				$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT vid FROM f_votos WHERE v_foto_id = \''.(int)$fid.'\'  AND v_user = \''.$tsUser->uid.'\' LIMIT 1');
				$votado = db_exec('num_rows', $query);
				
				if(empty($votado)){
					// SUMAR VOTO
					db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE f_fotos SET '.$voto.' WHERE foto_id = \''.(int)$fid.'\'');
					// INSERTAR EN TABLA
					if(db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `f_votos` (`v_foto_id`, `v_user`, `v_type`, `v_date`) VALUES (\''.(int)$fid.'\', \''.$tsUser->uid.'\', \''.$type.'\', \''.time().'\')')) return '1: Votado';
					//
				} return '0: Ya has votado esta foto.';
			} else return '0: No puedes votar tu propia foto.';
		} else return '0: Lo sentimos, para poder votar debes estar registrado.';
    }
    /************ COMENTARIOS *******************/
    /*
        newComentario()
    */
    function newComentario(){
        global $tsCore, $tsUser, $tsMonitor;
	
		if($tsUser->is_member && $tsUser->info['user_baneado'] == 0 && $tsUser->info['user_activo'] == 1 && ($tsUser->is_admod || $tsUser->permisos['gopcf'])) {

		// NO MAS DE 1500 CARACTERES PUES NADIE COMENTA TANTO xD
		$comentario = $tsCore->setSecure(substr($_POST['comentario'],0,1500), true);
		$fid = intval($_POST['fotoid']);
        /* COMPROVACIONES */
        $tsText = preg_replace('# +#',"",$comentario);
        $tsText = str_replace(array("\n","\t"),"",$tsText);
        if($tsText == '') return '0: El campo <b>Mensaje</b> es requerido para esta operaci&oacute;n';
        /* DE QUIEN ES LA FOTO */
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT f_user, f_closed FROM f_fotos WHERE foto_id = \''.(int)$fid.'\' LIMIT 1');
		$data = db_exec('fetch_assoc', $query);
		
        //
        $fecha = time();
        // VAMOS...
        if($data['f_user']){
            if($data['f_closed'] != 1 || $data['f_user'] == $tsUser->uid){
                // ANTI FLOOD
                $tsCore->antiFlood();
                //
				$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
                if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) { die('0: Su ip no se pudo validar.'); }
				if(db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO f_comentarios (c_foto_id, c_user, c_date, c_body, c_ip) VALUES (\''.(int)$fid.'\', \''.$tsUser->uid.'\', \''.$fecha.'\', \''.$comentario.'\', \''.$_SERVER['REMOTE_ADDR'].'\')')) {
        		  	$cid = db_exec('insert_id');
                    // ESTADÍSTICAS
                    db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `w_stats` SET `stats_foto_comments` = stats_foto_comments + \'1\' WHERE `stats_no` = \'1\'');
                    // NOTIFICAR AL USUARIO
                    $tsMonitor->setNotificacion(11, $data['f_user'], $tsUser->uid, $fid);
        		  	// array(comid, com, fecha, autor_del_post)
        			return array($cid,$tsCore->parseBadWords($tsCore->parseSmiles($comentario), true), $fecha, $_POST['auser']);
        		} else return '0: Ocurri&oacute; un error int&eacute;ntalo m&aacute;s tarde.';
            } else return '0: La foto se encuentra cerrada y no se permiten comentarios.';
        } else return '0: La foto no existe.';
	 } else return '0: Necesitas permisos para continuar.';
   }
    /*
        delComentario()
    */
    function delComentario(){
        global $tsCore, $tsUser;
        //
        $cid = $tsCore->setSecure($_POST['cid']);
        // DATOS
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT c.cid, c.c_user, f.foto_id, f.f_user FROM f_comentarios AS c LEFT JOIN f_fotos AS f ON c.c_foto_id = f.foto_id WHERE c.cid = \''.(int)$cid.'\' LIMIT 1');
        $data = db_exec('fetch_assoc', $query);
        
        //
        if(!empty($data['cid'])){
            // ES EL DUEÑO DE LA FOTO?
            if($data['f_user'] == $tsUser->uid || $tsUser->is_admod || $tsUser->permisos['moecf']){
			if(db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM f_comentarios WHERE cid = \''.(int)$cid.'\'')){
			     db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `w_stats` SET `stats_foto_comments` = stats_foto_comments - \'1\' WHERE `stats_no` = \'1\'');
                    return '1: Borrado';
                }
            } else return '0: Hmmm... &iquest;Haciendo pruebas?';
        } else return '0: El comentario no existe.'; 
    }
}