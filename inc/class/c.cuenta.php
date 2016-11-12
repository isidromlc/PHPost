<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Modelo para el control y edición de la cuenta de usuario
 *
 * @name    c.cuenta.php
 * @author  PHPost Team
 */
class tsCuenta {

	// INSTANCIA DE LA CLASE
	public static function &getInstance(){
		static $instance;
		
		if( is_null($instance) ){
			$instance = new tsCuenta();
    	}
		return $instance;
	}
    /**
     * @name loadPerfil()
     * @access public
     * @uses Cargamos el perfil de un usuario
     * @param int
     * @return array
     */
	public function loadPerfil($user_id = 0){
		global$tsUser;
		//
		if(empty($user_id)) $user_id = $tsUser->uid;
		//
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT p.*, u.user_registro, u.user_lastactive FROM u_perfil AS p LEFT JOIN u_miembros AS u ON p.user_id = u.user_id WHERE p.user_id = \''.(int)$user_id.'\' LIMIT 1');
		$perfilInfo = db_exec('fetch_assoc', $query);
        
		// CAMBIOS
        $perfilInfo = $this->unData($perfilInfo);
		// PORCENTAJE
        $total = unserialize($perfilInfo['p_total']);
		$perfilInfo['porcentaje'] = $this->getPorcentVal($total);
		//
		return $perfilInfo;
	}
    /*
        loadExtras()
    */
    private function unData($data){
        //
		$data['p_gustos'] = unserialize($data['p_gustos']);
		$data['p_tengo'] = unserialize($data['p_tengo']);
		$data['p_idiomas'] = unserialize($data['p_idiomas']);
        //
		$data['p_socials'] = unserialize($data['p_socials']);
		$data['p_socials']['f'] = $data['p_socials'][0];
		$data['p_socials']['t'] = $data['p_socials'][1];
        //
        $data['p_configs'] = unserialize($data['p_configs']);
        //
        return $data;
    }
	/*
		loadHeadInfo($user_id)
	*/
	function loadHeadInfo($user_id){
		global $tsUser, $tsCore;
		// INFORMACION GENERAL
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_id, u.user_name, u.user_registro, u.user_lastactive, u.user_activo, u.user_baneado, p.user_sexo, p.user_pais, p.p_nombre, p.p_avatar, p.p_mensaje, p.p_socials, p.p_empresa, p.p_configs FROM u_miembros AS u, u_perfil AS p WHERE u.user_id = \''.(int)$user_id.'\' AND p.user_id = \''.(int)$user_id.'\'');
		$data = db_exec('fetch_assoc', $query);
        
        //
        $data['p_nombre'] = $tsCore->setSecure($tsCore->parseBadWords($data['p_nombre']), true);
        $data['p_mensaje'] = $tsCore->setSecure($tsCore->parseBadWords($data['p_mensaje']), true);
		$data['p_socials'] = unserialize($data['p_socials']);
		$data['p_socials']['f'] = $data['p_socials'][0];
		$data['p_socials']['t'] = $data['p_socials'][1];
		$data['p_configs'] = unserialize($data['p_configs']);

		
		if($data['p_configs']['hits'] == 0){
		$data['can_hits'] = false;
		}elseif($data['p_configs']['hits'] == 3 && ($this->iFollow($user_id) || $tsUser->is_admod)){
		$data['can_hits'] = true;
		}elseif($data['p_configs']['hits'] == 4 && ($this->yFollow($user_id) || $tsUser->is_admod)){
		$data['can_hits'] = true;
		}elseif($data['p_configs']['hits'] == 5 && $tsUser->is_member){
		$data['can_hits'] = true;
		}elseif($data['p_configs']['hits'] == 6){
		$data['can_hits'] = true;
		}
		
		if($data['can_hits']){
		$data['visitas'] = result_array(db_exec(array(__FILE__, __LINE__), 'query', 'SELECT v.*, u.user_id, u.user_name FROM w_visitas AS v LEFT JOIN u_miembros AS u ON v.user = u.user_id WHERE v.for = \''.(int)$user_id.'\' && v.type = \'1\' && user > 0 ORDER BY v.date DESC LIMIT 7'));
		$q1 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(u.user_id) AS a FROM w_visitas AS v LEFT JOIN u_miembros AS u ON v.user = u.user_id WHERE v.for = \''.(int)$user_id.'\' && v.type = \'1\''));
		$data['visitas_total'] = $q1[0];
        }
		

		$visitado = db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT id FROM `w_visitas` WHERE `for` = \''.(int)$user_id.'\' && `type` = \'1\' && '.($tsUser->is_member ? '(`user` = \''.$tsUser->uid.'\' OR `ip` LIKE \''.$_SERVER['REMOTE_ADDR'].'\')' : '`ip` LIKE \''.$_SERVER['REMOTE_ADDR'].'\'').' LIMIT 1'));
		if(($tsUser->is_member && $visitado == 0 && $tsUser->uid != $user_id) || ($tsCore->settings['c_hits_guest'] == 1 && !$tsUser->is_member && !$visitado)) {
			db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO w_visitas (`user`, `for`, `type`, `date`, `ip`) VALUES (\''.$tsUser->uid.'\', \''.(int)$user_id.'\', \'1\', \''.time().'\', \''.$_SERVER['REMOTE_ADDR'].'\')');
			//db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_perfil SET p_visitas = p_visitas + 1 WHERE user_id = \''.(int)$user_id.'\''); // Eliminado en 1.1.000.9
		}else{
		db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE `w_visitas` SET `date` = \''.time().'\', ip = \''.$_SERVER['REMOTE_ADDR'].'\' WHERE `for` = \''.(int)$post_id.'\' && `type` = \'1\'');
		}
		
		// REAL STATS
		$data['stats'] = db_exec('fetch_assoc', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_id, u.user_rango, u.user_puntos, u.user_posts, u.user_comentarios, u.user_seguidores, u.user_cache, r.r_name, r.r_color FROM u_miembros AS u LEFT JOIN u_rangos AS r ON  u.user_rango = r.rango_id WHERE u.user_id = \''.(int)$user_id.'\''));
		
        if($data['stats']['user_cache'] < time()-($tsCore->settings['c_stats_cache']*60)){
        $q1 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(post_id) AS p FROM p_posts WHERE post_user = \''.(int)$user_id.'\' && post_status = \'0\''));
        $q2 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(follow_id) AS s FROM u_follows WHERE f_id =\''.(int)$user_id.'\' && f_type = \'1\''));
        $q3 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(cid) AS c FROM p_comentarios WHERE c_user = \''.(int)$user_id.'\' && c_status = \'0\''));
        
        $data['stats']['user_posts'] = $q1[0];
		$data['stats']['user_seguidores'] = $q2[0];
		$data['stats']['user_comentarios'] = $q3[0];
        db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_miembros SET user_posts = \''.$q1[0].'\', user_comentarios = \''.$q3[0].'\', user_seguidores = \''.$q2[0].'\', user_cache = \''.time().'\' WHERE  user_id = \''.(int)$user_id.'\'');
        }
        $q4 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(foto_id) AS f FROM f_fotos WHERE f_user = \''.(int)$user_id.'\' && f_status = \'0\''));
        $data['stats']['user_fotos'] = $q4[0];
		
		// BLOQUEADO
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT * FROM `u_bloqueos` WHERE b_user = \''.$tsUser->uid.'\' AND b_auser = \''.(int)$user_id.'\' LIMIT 1');
        $data['block'] = db_exec('fetch_assoc', $query);
        
        //
		return $data;
	}
	/*
		loadGeneral($user_id)
	*/
	function loadGeneral($user_id){
		global $tsCore;
		// MEDALLAS
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT m.*, a.* FROM w_medallas AS m LEFT JOIN w_medallas_assign AS a ON a.medal_id = m.medal_id WHERE a.medal_for = \''.(int)$user_id.'\' AND m.m_type = \'1\' ORDER BY a.medal_date DESC LIMIT 21');
		$data['medallas'] = result_array($query);
        $data['m_total'] = count($data['medallas']);
        
		// SEGUIDORES
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT f.follow_id, u.user_id, u.user_name FROM u_follows AS f LEFT JOIN u_miembros AS u ON f.f_user = u.user_id WHERE f.f_id = \''.(int)$user_id.'\' && f.f_type = \'1\' && u.user_activo = \'1\' && u.user_baneado = \'0\' ORDER BY f.f_date DESC LIMIT 21');
        $data['segs']['data'] = result_array($query);
        $data['segs']['total'] = count($data['segs']['data']);
        
		// SIGUIENDO
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT f.follow_id, u.user_id, u.user_name FROM u_follows AS f LEFT JOIN u_miembros AS u ON f.f_id = u.user_id WHERE f.f_user = \''.(int)$user_id.'\' AND f.f_type = \'1\' && u.user_activo = \'1\' && u.user_baneado = \'0\' ORDER BY f.f_date DESC LIMIT 21');
        $data['sigd']['data'] = result_array($query);
        $data['sigd']['total'] = count($data['sigd']['data']);
        
        // ULTIMAS FOTOS
        if(empty($_GET['pid'])){
		    $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT foto_id, f_title, f_url FROM f_fotos WHERE f_user = \''.(int)$user_id.'\' ORDER BY foto_id DESC LIMIT 6');
            $data['fotos'] = result_array($query);
            $total = count($data['fotos']);
            $data['fotos_total'] = $total;
            if($total < 6){
                for($i = $total; $i <= 5; $i++){
                    $data['fotos'][$i] = NULL;
                }
            }
            
        }
        //
		return $data;
	}
    /*
        iFollow()
    */
    function iFollow($user_id){
        global $tsUser;
        // SEGUIR
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT follow_id FROM u_follows WHERE f_id = \''.(int)$user_id.'\' AND f_user = \''.(int)$tsUser->uid.'\' AND f_type = \'1\' LIMIT 1');
		$data = db_exec('num_rows', $query);
		
        //
        return ($data > 0) ? true : false;
    }
	
	/*
       yFollow()
    */
    function yFollow($user_id){
        global $tsUser;
        // YO LE SIGO?
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT follow_id FROM u_follows WHERE f_id = \''.(int)$tsUser->uid.'\' AND f_user = \''.(int)$user_id.'\' AND f_type = \'1\' LIMIT 1');
		$data = db_exec('num_rows', $query);
		
        //
        return ($data > 0) ? true : false;
    }
    /*
        loadPosts($user_id)
    */
    function loadPosts($user_id){
        global $tsUser;
        //
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT p.post_id, p.post_title, p.post_puntos, c.c_seo, c.c_img FROM p_posts AS p LEFT JOIN p_categorias AS c ON c.cid = p.post_category WHERE p.post_status = \'0\' AND p.post_user = \''.(int)$user_id.'\' ORDER BY p.post_date DESC LIMIT 18');
        $data['posts'] = result_array($query);
        $data['total'] = count($data['posts']);
        
        // USUARIO
        $data['username'] = $tsUser->getUserName($user_id);
        //
        return $data;
    }
	/*
        loadMedallas($user_id)
    */
    function loadMedallas($user_id){
        //
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT m.*, a.* FROM w_medallas AS m LEFT JOIN w_medallas_assign AS a ON a.medal_id = m.medal_id WHERE a.medal_for = \''.(int)$user_id.'\' AND m.m_type = \'1\' ORDER BY a.medal_date DESC');
		$data['medallas'] = result_array($query);
        $data['total'] = count($data['medallas']);
        
        //
        return $data;
    }
	/*
		savePerfil()
	*/
	function savePerfil(){
		global $tsCore, $tsUser;
		//
		$save = $_POST['save'];
		$maxsize = 1000;	// LIMITE DE TEXTO
		// GUARDAR...
		switch($save){
			case 1:
                // NUEVOS DATOS
				$perfilData = array(
					'email' => $tsCore->setSecure($_POST['email'], true),
					'pais' => $tsCore->setSecure($_POST['pais']),
					'estado' => $tsCore->setSecure($_POST['estado']),
					'sexo' => ($_POST['sexo'] == 'f') ? 0 : 1,
					'dia' => (int)$_POST['dia'],
					'mes' => (int)$_POST['mes'],
					'ano' => (int)$_POST['ano'],
					'firma' => $tsCore->setSecure($tsCore->parseBadWords($_POST['firma']), true),
				);
                //
                $year = date("Y",time());
                // ANTIGUOS DATOS
				$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT user_dia, user_mes, user_ano, user_pais, user_estado, user_sexo, user_firma FROM U_perfil WHERE user_id = \''.$tsUser->uid.'\' LIMIT 1');
                $info = db_exec('fetch_assoc', $query);
                
                //
                $email_ok = $this->isEmail($perfilData['email']);
                // CORRECCIONES
				if(!$email_ok){
					$msg_return = array('field' => 'email', 'error' => 'El formato de email ingresado no es v&aacute;lido.');
					// EL ANTERIOR
					$perfilData['email'] = $tsUser->info['user_email'];
				}
				elseif(!checkdate($perfilData['mes'],$perfilData['dia'],$perfilData['ano']) || ($perfilData['ano'] > $year || $perfilData['ano'] < ($year - 100))){
					$msg_return = array('error' => 'La fecha de nacimiento no es v&aacute;lida.');
					// LOS ANTERIORES
					$perfilData['mes'] = $info['user_mes'];
					$perfilData['dia'] = $info['user_dia'];
					$perfilData['ano'] = $info['user_ano'];
				}
				elseif($perfilData['sexo'] > 2){
					$msg_return = array('error' => 'Especifica un g&eacute;nero sexual.');
					$perfilData['sexo'] = $info['user_sexo'];
				}
				elseif(empty($perfilData['pais'])){
					$msg_return = array('error' => 'Por favor, especifica tu pa&iacute;s.');
					$perfilData['pais'] = $info['user_pais'];
				}
				elseif(empty($perfilData['estado'])){
					$msg_return = array('error' => 'Por favor, especifica tu estado.'.$_POST['estado']);
					$perfilData['estado'] = $info['user_estado'];
				}
                elseif(strlen($perfilData['firma']) > 300){
                    $msg_return = array('error' => 'La firma no puede superar los 300 caracteres.');
                    $perfilData['firma'] = $info['user_firma'];
                }
				elseif($tsUser->info['user_email'] != $perfilData['email']) {
				    $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT user_id FROM u_miembros WHERE user_email = \''.$tsCore->setSecure($perfilData['email']).'\' LIMIT 1');
                    $exists = db_exec('num_rows', $query);
                    
                    if($exists) {
                        $msg_return = array('error' => 'Este email ya existe, ingresa uno distinto.');
                        $perfilData['email'] = $tsUser->info['user_email'];
                    }
					else $msg_return = array('error' => 'Los cambios fueron aceptados y ser&aacute;n aplicados en los pr&oacute;ximos minutos. NO OBSTANTE, la nueva direcci&oacute;n de correo electr&oacute;nico especificada debe ser comprobada. '.$tsCore->settings['titulo'].' envi&oacute; un mensaje de correo electr&oacute;nico con las instrucciones necesarias');
				}
			break;
			case 2:
                // INTERNOS
                $sitio = trim($_POST['sitio']);
                if(!empty($sitio)) $sitio = substr($sitio, 0, 4) == 'http' ? $sitio : 'http://'.$sitio;
				// EXTERNAS
				$facebook = $tsCore->setSecure($tsCore->parseBadWords($_POST['facebook']), true);
				$twitter = $tsCore->setSecure($tsCore->parseBadWords($_POST['twitter']), true);
				for($i = 0; $i < 5; $i++) $gustos[$i] = $tsCore->setSecure($tsCore->parseBadWords($_POST['g_'.$i]), true);
				// IN DB
				$perfilData = array(
					'nombre' => $tsCore->setSecure($tsCore->parseBadWords($_POST['nombrez']), true),
					'mensaje' => $tsCore->setSecure($tsCore->parseBadWords($_POST['mensaje']), true),
					'sitio' => $tsCore->setSecure($tsCore->parseBadWords($sitio), true),
					'socials' => serialize(array($facebook,$twitter)),
					'gustos' => serialize($gustos),
					'estado' => $tsCore->setSecure($_POST['estado']),
					'hijos' => $tsCore->setSecure($_POST['hijos']),
					'vivo' => $tsCore->setSecure($_POST['vivo']),
				);
                // COMPROBACIONES
                if(!empty($perfilData['sitio']) && !filter_var($perfilData['sitio'], FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED)) return array('error' => 'El sitio web introducido no es correcto.');
			break;
			case 3:
				// EXTRAS
				$tengo = array($tsCore->setSecure($_POST['t_0']),$tsCore->setSecure($_POST['t_1']));
				$perfilData = array(
					'altura' => $tsCore->setSecure($_POST['altura']),
					'peso' => $tsCore->setSecure($_POST['peso']),
					'pelo' => $tsCore->setSecure($_POST['pelo_color']),
					'ojos' => $tsCore->setSecure($_POST['ojos_color']),
					'fisico' => $tsCore->setSecure($_POST['fisico']),
					'dieta' => $tsCore->setSecure($_POST['dieta']),
					'tengo' => serialize($tengo),
					'fumo' => $tsCore->setSecure($_POST['fumo']),
					'tomo' => $tsCore->setSecure($_POST['tomo_alcohol']),
				);
			break;
			case 4:
				// EXTRAS
				for($i = 0; $i<7;$i++) $idiomas[$i] = $tsCore->setSecure($_POST['idioma_'.$i]);
				$perfilData = array(
					'estudios' => $tsCore->setSecure($_POST['estudios']),
					'idiomas' => serialize($idiomas),
					'profesion' => $tsCore->setSecure($tsCore->parseBadWords($_POST['profesion'], true)),
					'empresa' => $tsCore->setSecure($tsCore->parseBadWords($_POST['empresa'],true)),
					'sector' => $tsCore->setSecure($_POST['sector']),
					'ingresos' => $tsCore->setSecure($_POST['ingresos']),
					'int_prof' => $tsCore->setSecure(substr($_POST['intereses_profesionales'],0,$maxsize), true),
					'hab_prof' => $tsCore->setSecure(substr($_POST['habilidades_profesionales'],0,$maxsize), true),
				);
			break;
			case 5:
				$perfilData = array(
					'intereses' => $tsCore->setSecure($tsCore->parseBadWords(substr($_POST['intereses'],0,$maxsize)), true),
					'hobbies' => $tsCore->setSecure($tsCore->parseBadWords(substr($_POST['hobbies'],0,$maxsize)), true),
					'tv' => $tsCore->setSecure($tsCore->parseBadWords(substr($_POST['tv'],0,$maxsize)), true),
					'musica' => $tsCore->setSecure($tsCore->parseBadWords(substr($_POST['musica'],0,$maxsize)), true),
					'deportes' => $tsCore->setSecure($tsCore->parseBadWords(substr($_POST['deportes'],0,$maxsize)), true),
					'libros' => $tsCore->setSecure($tsCore->parseBadWords(substr($_POST['libros'],0,$maxsize)), true),
					'peliculas' => $tsCore->setSecure($tsCore->parseBadWords(substr($_POST['peliculas'],0,$maxsize)), true),
					'comida' => $tsCore->setSecure($tsCore->parseBadWords(substr($_POST['comida'],0,$maxsize)), true),
					'heroes' => $tsCore->setSecure($tsCore->parseBadWords(substr($_POST['heroes'],0,$maxsize)), true),
				);
			break;
            // NEW PASSWORD
            case 6:
                $passwd = $_POST['passwd'];
                $new_passwd = $_POST['new_passwd'];
                $confirm_passwd = $_POST['confirm_passwd'];
                if(empty($new_passwd) || empty($confirm_passwd)) return array('error' => 'Debes ingresar una contrase&ntilde;a.');
                elseif(strlen($new_passwd) < 5) return array('error' => 'Contrase&ntilde;a no v&aacute;lida.');
                elseif($new_passwd != $confirm_passwd) return array('error' => 'Tu nueva contrase&ntilde;a debe ser igual a la confirmaci&oacute;n de la misma.');
                else {
                    $key = md5(md5($passwd).strtolower($tsUser->nick));
                    if($key != $tsUser->info['user_password']) return array('error' => 'Tu contrase&ntilde;a actual no es correcta.');
                    else {
                        $new_key = md5(md5($new_passwd).strtolower($tsUser->nick));
						if(db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_miembros SET user_password = \''.$tsCore->setSecure($new_key).'\' WHERE user_id = \''.$tsUser->uid.'\'')) return true;
                    }
                }
            break;
            case 7:
                $muro_firm = ($_POST['muro_firm'] > 4) ? 5 : $_POST['muro_firm'];
				$rec_mps = ($_POST['rec_mps'] > 6) ? 5 : $_POST['rec_mps'];
				$see_hits = ($_POST['last_hits'] == 1 || $_POST['last_hits'] == 2) ? 0 : $_POST['last_hits'];
                $array = array('m' => $_POST['muro'], 'mf' => $muro_firm, 'rmp' => $rec_mps, 'hits' => $see_hits);
                //
                $perfilData['configs'] = serialize($array);
            break;
			case 8: //2678400 es un mes :)
				$nuevo_nick = htmlspecialchars($_POST['new_nick']);
                if(db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT id FROM w_blacklist WHERE type = \'4\' && LOWER(value) = \''.$tsCore->setSecure($nuevo_nick).'\' LIMIT 1'))) return array('error' => 'Nick no permitido');
                if(db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT user_id FROM u_miembros WHERE LOWER(user_name) = \''.$tsCore->setSecure($nuevo_nick).'\' LIMIT 1'))) return array('error' => 'Nombre en uso');
				$data = db_exec('fetch_assoc', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT id, user_id, time FROM u_nicks WHERE user_id = \''.$tsUser->uid.'\' AND estado = 0 LIMIT 1'));
				if(!empty($data['id'])) return array('error' => 'Ya tiene una petici&oacute;n  de cambio en curso');
				elseif(time() - $data['time'] >= 31536000) db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_miembros SET user_name_changes = \'3\' WHERE user_id = \''.$data['user_id'].'\'');
				$key = md5(md5($_POST['password']).strtolower($tsUser->nick)); 
				if($key != $tsUser->info['user_password']) return array('error' => 'Tu contrase&ntilde;a actual no es correcta.');
                else {		
				$email_ok = $this->isEmail($_POST['pemail']);
				if(!$email_ok) return array('field' => 'email', 'error' => 'El formato de email ingresado no es v&aacute;lido.');
				$email = empty($_POST['pemail']) ? $tsUser->info['user_email'] : $_POST['pemail'];
				if(strlen($nuevo_nick) < 4 || strlen($nuevo_nick) > 16) return array('error' => 'El nick debe tener entre 4 y 16 car&aacute;cteres');
				if(!preg_match('/^([A-Za-z0-9]+)$/', $nuevo_nick)) return array('error' => 'El nick debe ser alfanum&eacute;rico');
				$key = md5(md5($_POST['password']).strtolower($nuevo_nick));
				$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
                if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) return array('error' => 'Su IP no se pudo validar');
				if(db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `u_nicks` (`user_id`, `user_email`, `name_1`, `name_2`, `hash`, `time`, `ip`) VALUES (\''.$tsUser->uid.'\', \''.$tsCore->setSecure($email).'\', \''.$tsUser->nick.'\', \''.$tsCore->setSecure($nuevo_nick).'\', \''.$key.'\', \''.time().'\', \''.$tsCore->setSecure($_SERVER['REMOTE_ADDR']).'\')')) return array('error' => 'Proceso iniciado, recibir&aacute; la respuesta en el correo indicado cuando valoremos el cambio.');
				}
            break;
		}
		// COMPROBAR PORCENTAJE
		$total = array(5,8,9,8,9); // CAMPOS EN CADA CATEGORIA
		$tid = $save - 1;
        if($save > 1 && $save < 6){
    		$total[$tid] = $this->getPorcentTotal($perfilData, $total[$tid]);
    		if($save == 1) $total[$tid] = $total[$tid] - 2;
			$porcen = db_exec('fetch_assoc', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT p_total FROM u_perfil WHERE user_id = \''.$tsUser->uid.'\' LIMIT 1'));
    		$porcen = unserialize($porcen['p_total']);
    		$porcen[$tid] = $total[$tid];
    		$porcenNow = $this->getPorcentVal($porcen);
    		$porcen = serialize($porcen);
			db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_perfil SET p_total = \''.$porcen.'\' WHERE user_id = \''.$tsUser->uid.'\'');
        }
		// ACTUALIZAR
		if($save == 1) {
		    db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_miembros SET user_email = \''.$tsCore->setSecure($perfilData['email'], true).'\' WHERE user_id = \''.$tsUser->uid.'\'');
            array_splice($perfilData, 0, 1); // HACK
            $updates = $tsCore->getIUP($perfilData, 'user_');
			if(!db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_perfil SET '.$updates.' WHERE user_id = \''.$tsUser->uid.'\'')) return array('error' => show_error('Error al ejecutar la consulta de la l&iacute;nea '.__LINE__.' de '.__FILE__.'.', 'db'));
		} else {
			$updates = $tsCore->getIUP($perfilData, 'p_');
			if(!db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_perfil SET '.$updates.' WHERE user_id = \''.$tsUser->uid.'\'')) return array('error' => show_error('Error al ejecutar la consulta de la l&iacute;nea '.__LINE__.' de '.__FILE__.'.', 'db')); 
		}
		//
		if(is_array($msg_return)) return $msg_return;
		else return array('porc' => $porcenNow);
	}
	/*
		checkEmail()
	*/
	function isEmail($email){
		if(preg_match("/^[_a-zA-Z0-9-]+(.[_a-zA-Z0-9-]+)*@([_a-zA-Z0-9-]+.)*[a-zA-Z0-9-]{2,200}.[a-zA-Z]{2,6}$/",$email)) return true;
		else return false;
	}
	/*
		getPorcentVal($array)
	*/
	function getPorcentVal($array){
		//
		$total = $array[0] + $array[1] + $array[2] + $array[3] + $array[4] + $array[5];
		return round((100 * $total) / 40);
	}
	/*
		getPorcentTotal($array, $total) // Recursividad xD
	*/
	function getPorcentTotal($array, $total){
		//
		foreach($array as $i => $val) { 
			$valt = unserialize($val);
			if(is_array($valt)) {
				$stotal = $this->getPorcentTotal($valt, count($valt));
				if(empty($stotal)) $total--;
			}
			elseif(empty($val)) $total--;
		}
		//
		return $total;
	}
	
	function desCuenta() {
	global $tsUser, $tsCore;
	if(db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_miembros SET user_activo = \'0\' WHERE user_id = \''.$tsUser->uid.'\''))
	 $tsCore->redirectTo($tsCore->settings['url'].'/login-salir.php');
	 return 1;
	}
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
							// MANEJAR IMAGES \\
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*
		loadImages($user_id)
	*/
	function loadImages($user_id = 0){
		global $tsUser;
		//
		if(empty($user_id)) $user_id = $tsUser->uid;
		$images = result_array(db_exec(array(__FILE__, __LINE__), 'query', 'SELECT * FROM u_fotos WHERE f_user = \''.(int)$user_id.'\''));
		//
		return $images;
	}
	/*
		addImagen()
	*/
	function addImagen(){
		global $tsCore, $tsUser;
		//
		$img_url = $tsCore->setSecure($tsCore->parseBadWords(substr($_POST['url'],0,255)), true);
		$img_cap = $tsCore->setSecure($tsCore->parseBadWords(substr($_POST['caption'],0,50)), true);
		// INSERTAMOS
		if(empty($img_url) || $img_url == 'http://') return array('field' => 'url', 'error' => 'Ingresa la URL de la imagen.');
		else {
		    db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO u_fotos (f_user, f_url, f_caption) VALUES (\''.$tsUser->uid.'\', \''.$img_url.'\', \''.$img_cap.'\')');
			return array('id' => db_exec('insert_id'), 'field' => '', 'error' => '');
		}
	}
	/*
		delImagen()
	*/
	function delImagen(){
		global $tsCore, $tsUser;
		//
		$img_id = $tsCore->setSecure($_POST['id']);
		// BORRANDO
		db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM u_fotos WHERE foto_id = \''.(int)$img_id.'\' AND f_user = \''.$tsUser->uid.'\'');
	}
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
							// MANEJAR BLOQUEOS \\
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    function bloqueosCambiar(){
        global $tsCore, $tsUser;
        //
        $auser = $tsCore->setSecure($_POST['user']);
        $bloquear = empty($_POST['bloquear']) ? 0 : 1;
        // EXISTE?
        $exists = $tsUser->getUserName($auser);
        // SI EXISTE Y NO SOY YO
        if($exists && $tsUser->uid != $auser){
            if($bloquear == 1){
                // YA BLOQUEADO?
				$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT bid FROM u_bloqueos WHERE b_user = \''.$tsUser->uid.'\' AND b_auser = \''.(int)$auser.'\' LIMIT 1');
                $noexists = db_exec('num_rows', $query);
                
                // NO HA SIDO BLOQUEADO
                if(empty($noexists)) {
				    if(db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO u_bloqueos (b_user, b_auser) VALUES (\''.$tsUser->uid.'\', \''.(int)$auser.'\')'))
                    return "1: El usuario fue bloqueado satisfactoriamente."; 
                } else return '0: Ya has bloqueado a este usuario.';
                // 
            } else{
			    if(db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM u_bloqueos WHERE b_user = \''.$tsUser->uid.'\'  AND b_auser = \''.(int)$auser.'\''))
                return "1: El usuario fue desbloqueado satisfactoriamente.";
            }
        } else return '0: El usuario seleccionado no existe.';
    }
    /*
        loadBloqueos()
    */
    function loadBloqueos(){
        global $tsUser;
        //
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT b.*, u.user_name FROM u_miembros AS u LEFT JOIN u_bloqueos AS b ON u.user_id = b.b_auser WHERE b.b_user = \''.(int)$tsUser->uid.'\'');
        $data = result_array($query);
        
        //
        return $data;
    }
}