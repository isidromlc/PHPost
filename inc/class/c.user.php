<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Modelo para el control de los usuarios
 *
 * @name    c.user.php
 * @author  PHPost Team
 */
class tsUser {

	var $info = array();	// SI EL USUARIO ES MIEMBRO CARGAMOS DATOS DE LA TABLA
	var $is_member = 0;		// EL USUARIO ESTA LOGUEADO?
    var $is_admod = 0;
    var $is_banned = 0;
	var $nick = 'Visitante';// NOMBRE A MOSTRAR
	var $uid = 0;			// USER ID
	var $is_error;			// SI OCURRE UN ERROR ESTA VARIABLE CONTENDRA EL NUMERO DE ERROR
	var $session;

	function tsUser()
    {
		global $tsCore, $tsMedal;
		/* CARGAR SESSION */
        $this->session = new tsSession();
        $this->setSession();
		
		if($this->is_member)
        {
    		// ACTUALIZAR PUNTOS POR DIA :D
    		$this->actualizarPuntos();

		}
	}
	/*
		actualizarPuntos()
		: CASI 2 HORAS PARA PODER CREAR ESTA FUNCION D:
		: SI QUE ERA DIFICIL XD
	*/
	function actualizarPuntos()
    {
		// HORA EN LA CUAL RECARGAR PUNTOS 0 = MEDIA NOCHE DEL SERVIDOR
		$ultimaRecarga = $this->info['user_nextpuntos'];
		$tiempoActual = time();
		// SI YA SE PASO EL TIEMPO RECARGAMOS...
		if($ultimaRecarga < $tiempoActual){
			// OPERACION SIG RECARGA A LAS 24 HRS
            $horaActual = date("G",$tiempoActual);
            $minActuales = date("i",$tiempoActual) * 60;
            $segActuales = date("s",$tiempoActual);
			$sigRecarga = 24 - $horaActual;
			$sigRecarga = ($sigRecarga * 3600) - ($minActuales + $segActuales);
			$sigRecarga = $tiempoActual + $sigRecarga;
			// LA SIGUIENTE RECARGA SE HARA A MEDIA NOCHE DEL SIGUIENTE DIA LA HORA DEPENDE DEL SERVIDOR
			//
            db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_miembros SET user_puntosxdar = '.($tsCore->settings['c_keep_points'] == 0 ? $this->permisos['gopfd'] : 'user_puntosxdar + '.$this->permisos['gopfd']).', user_nextpuntos = '.$sigRecarga.' WHERE user_id = \''.$this->uid.'\'');
			// VAMONOS
			return true;
		}
	}
	
	/*
		DarMedalla()
	*/
	function DarMedalla(){
		//
        $q1 = db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT wm.medal_id FROM w_medallas AS wm LEFT JOIN w_medallas_assign AS wma ON wm.medal_id = wma.medal_id WHERE wm.m_type = \'1\' AND wma.medal_for = \''.$this->uid.'\''));        
		$q2 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(follow_id) AS f FROM u_follows WHERE f_id = \''.$this->uid.'\' && f_type = \'1\''));
        $q3 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(follow_id) AS s FROM u_follows WHERE f_user = \''.$this->uid.'\' && f_type = \'1\''));
        $q4 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(cid) AS c FROM p_comentarios WHERE c_user = \''.$this->uid.'\' && c_status = \'0\''));
        $q5 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(cid) AS cf FROM f_comentarios WHERE c_user = \''.$this->uid.'\''));
        $q6 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(foto_id) AS fo FROM f_fotos WHERE f_status = \'0\' && f_user = \''.$this->uid.'\''));
        $q7 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(post_id) AS p FROM p_posts WHERE post_user = \''.$this->uid.'\' && post_status = \'0\''));
        // MEDALLAS
		$datamedal = result_array($query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT medal_id, m_cant, m_cond_user, m_cond_user_rango FROM w_medallas WHERE m_type = \'1\' ORDER BY m_cant DESC'));
		//		
		foreach($datamedal as $medalla){
			// DarMedalla
			if($medalla['m_cond_user'] == 1 && !empty($this->info['user_puntos']) && $medalla['m_cant'] > 0 && $medalla['m_cant'] <= $this->info['user_puntos']){
				$newmedalla = $medalla['medal_id'];
			}elseif($medalla['m_cond_user'] == 2 && !empty($q2[0]) && $medalla['m_cant'] > 0 && $medalla['m_cant'] <= $q2[0]){
				$newmedalla = $medalla['medal_id'];
			}elseif($medalla['m_cond_user'] == 3 && !empty($q3[0]) && $medalla['m_cant'] > 0 && $medalla['m_cant'] <= $q3[0]){
				$newmedalla = $medalla['medal_id'];
			}elseif($medalla['m_cond_user'] == 4 && !empty($q4[0]) && $medalla['m_cant'] > 0 && $medalla['m_cant'] <= $q4[0]){
				$newmedalla = $medalla['medal_id'];
			}elseif($medalla['m_cond_user'] == 5 && !empty($q5[0]) && $medalla['m_cant'] > 0 && $medalla['m_cant'] <= $q5[0]){
				$newmedalla = $medalla['medal_id'];
			}elseif($medalla['m_cond_user'] == 6 && !empty($q7[0]) && $medalla['m_cant'] > 0 && $medalla['m_cant'] <= $q7[0]){
				$newmedalla = $medalla['medal_id'];
			}elseif($medalla['m_cond_user'] == 7 && !empty($q6[0]) && $medalla['m_cant'] > 0 && $medalla['m_cant'] <= $q6[0]){
				$newmedalla = $medalla['medal_id'];
			}elseif($medalla['m_cond_user'] == 8 && !empty($q1) && $medalla['m_cant'] > 0 && $medalla['m_cant'] <= $q1){
				$newmedalla = $medalla['medal_id'];
			}elseif($medalla['m_cond_user'] == 9 && !empty($this->info['user_rango']) && $medalla['m_cant'] > 0 && $medalla['m_cond_user_rango'] == $this->info['user_rango']){
				$newmedalla = $medalla['medal_id'];
			}
			
		//SI HAY NUEVA MEDALLA, HACEMOS LAS CONSULTAS
		if(!empty($newmedalla)){
		if(!db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT id FROM w_medallas_assign WHERE medal_id = \''.(int)$newmedalla.'\' && medal_for = \''.$this->uid.'\''))){
		db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO `w_medallas_assign` (`medal_id`, `medal_for`, `medal_date`, `medal_ip`) VALUES (\''.(int)$newmedalla.'\', \''.$this->uid.'\', \''.time().'\', \''.$_SERVER['REMOTE_ADDR'].'\')');
		db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO u_monitor (user_id, obj_uno, not_type, not_date) VALUES (\''.$this->uid.'\', \''.(int)$newmedalla.'\', \'15\', \''.time().'\')');
		db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE w_medallas SET m_total = m_total + 1 WHERE medal_id = \''.(int)$newmedalla.'\'');}
		}
	   }
	  }
	// INSTANCIA DE LA CLASE
	public static function &getInstance(){
		static $instance;

		if( is_null($instance) ){
			$instance = new tsUser();
    	}
		return $instance;
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
							// MANEJAR SESSIONES \\
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*
		CARGA LA SESSION
		setSession()
	*/
	function setSession()
    {
        // Si no existe una sessión la creamos
        // si existe la actualizamos...
		if ( ! $this->session->read())
		{
			$this->session->create();
		}
		else
		{
            // Actualizamos sesión
			$this->session->update();
            // Cargamos información
            $this->loadUser();
		}
	}
	/*
		CARGAR USUARIO POR SU ID
		loadUser()
	*/
	function loadUser($login = FALSE)
    {
        // Cargar datos
        $sql = 'SELECT u.*, s.* FROM u_sessions s, u_miembros u WHERE s.session_id = \''.$this->session->ID.'\' AND u.user_id = s.session_user_id';
        $query = db_exec(array(__FILE__, __LINE__), 'query', $sql);
        $this->info = db_exec('fetch_assoc', $query);
        // Existe el usuario?
        if(!isset($this->info['user_id']))
        {
            return FALSE;
        }
        // PERMISOS SEGUN RANGO
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT r_name, r_color, r_image, r_allows FROM u_rangos WHERE rango_id = '.$this->info['user_id'].' LIMIT 1');
        $this->info['rango'] = db_exec('fetch_assoc', $query);
        
		// PERMISOS SEGUN RANGO
		$datis = db_exec('fetch_assoc', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT r_allows FROM u_rangos WHERE rango_id = \''.$this->info['user_rango'].'\' LIMIT 1'));
		$this->permisos = unserialize($datis['r_allows']);
        
		/* ES MIEMBRO */
		$this->is_member = 1;
		
		if($this->permisos['sumo'] == false && $this->permisos['suad'] == true){
		$this->is_admod = 1;
		}elseif($this->permisos['sumo'] == true && $this->permisos['suad'] == false){
		$this->is_admod = 2;
		}elseif($this->permisos['sumo'] || $this->permisos['suad']){
		$this->is_admod = true;
		}else{
		$this->is_admod = 0;
		}
		
		// NOMBRE
		$this->nick = $this->info['user_name'];
		$this->uid = $this->info['user_id'];
        $this->is_banned = $this->info['user_baneado'];
		// ULTIMA ACCION
		db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_miembros SET user_lastactive = \''.time().'\' WHERE user_id = \''.$this->uid.'\'');
        // Si ha iniciado sesión cargamos estos datos.
        if($login)
        {
            // Last login
			db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_miembros SET user_lastlogin = \''.$this->session->time_now.'\' WHERE user_id = \''.$this->uid.'\'');
            /* REGISTAR IP */
            db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_miembros SET user_last_ip = \''.$this->session->ip_address.'\' WHERE user_id = \''.$this->uid.'\'');
        }
        // Borrar variable session
        unset($this->session);

	}
	/*
		HACEMOS LOGIN
		loginUser($username, $password, $remember = false, $redirectTo = NULL);
	*/
	function loginUser($username, $password, $remember = FALSE, $redirectTo = NULL){
		global $tsCore;

		/* ARMAR VARIABLES */
		$username = strtolower($username);	// ARMAR VARIABLES
        $pp_password = md5(md5($password) . $username);
		/* CONSULTA */
        $pwtype = (db_exec('num_rows', db_exec(array(__FILE__, __LINE__), 'query', 'SHOW COLUMNS FROM u_miembros LIKE \'user_pwtype\'')) == 1) ? 'user_pwtype,' : '';      
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT user_id, user_password, ' . $pwtype . ' user_activo, user_baneado FROM u_miembros WHERE LOWER(user_name) = \''.$username.'\' LIMIT 1');
        //
        $data = db_exec('fetch_assoc', $query);
        
        if(empty($data)) return '0: El usuario no existe.';
        //
       	if($data['user_pwtype']){
       	    $other_passwords = array();
       	    $other_passwords[] = sha1($username . $password); // SMF 1.1.x, SMF 2.0.x
            $other_passwords[] = md5($password); // Zinfinal
            //
            if(in_array($data['user_password'], $other_passwords)){
                // UPDATE
				db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_miembros SET user_password = \''.$tsCore->setSecure($pp_password).'\', user_pwtype = \'0\' WHERE user_id = '.$data['user_id'].'');
                //
                $data['user_password'] = $pp_password;
            }
       	}
        // CHECAMOS
        if($data['user_password'] != $pp_password){
			return '0: Tu contrase&ntilde;a es incorrecta.';
		} else {
            if($data['user_activo'] == 1){
                // Actualizamos la session
                $this->session->update($data['user_id'], $remember, TRUE);
                // Cargamos la información del usuario
                $this->loadUser(true);
                // COMPROBAMOS SI TENEMOS QUE ASIGNAR MEDALLAS
                $this->DarMedalla();                
				/* REDERIGIR */
				if($redirectTo != NULL) $tsCore->redirectTo($redirectTo);	// REDIRIGIR
				else return TRUE;
			} else return '0: Debes activar tu cuenta';
		}
	}
	/*
		CERRAR SESSION
		logoutUser($redirectTo)
	*/
	function logoutUser($user_id, $redirectTo = '/'){
		global $tsCore;
		/* BORRAR SESSION */
        $this->session = new tsSession();
        $this->session->read();
        $this->session->destroy();
		/* LIMPIAR VARIABLES */
		$this->info = '';
		$this->is_member = 0;
        # UPDATE
        $last_active = (time() - (($tsCore->settings['c_last_active'] * 60) * 3));
		db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_miembros SET user_lastactive \''.$last_active.'\' WHERE user_id = \''.(int)$user_id.'\'');
		/* REDERIGIR */
		if($redirectTo != NULL) $tsCore->redirectTo($redirectTo);	// REDIRIGIR
		else return true;
	}
	/*
		userActivate()
	*/
	function userActivate($tsUserID = 0, $tsKey = 0){
		global $tsCore;
		//
		if(empty($tsUserID)) $tsUserID = (int)$_GET['uid'];
		if(empty($tsKey)) $tsKey = $tsCore->setSecure($_GET['key']);
		//
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT user_name, user_password, user_registro FROM u_miembros WHERE user_id = \''.$tsUserID.'\' LIMIT 1');
		$tsData = db_exec('fetch_assoc', $query);	// CARGAMOS DATOS
		$tsKeyLocal = md5($tsData['user_registro']);
		//
		if(db_exec('num_rows', $query) == 0 || $tsKey != $tsKeyLocal){
			return false;
		} else {
		    if(db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_miembros SET user_activo = 1 WHERE user_id = \''.$tsUserID.'\'')) {
                return $tsData;
			}
			else return false;
		}
	}
    /*
        getUserBanned()
    */
    function getUserBanned(){
        //
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT * FROM u_suspension WHERE user_id = \''.$this->uid.'\' LIMIT 1');
        $data = db_exec('fetch_assoc', $query);
        
        //
        $now = time();
        //
        if($data['susp_termina'] > 1 && $data['susp_termina'] < $now){
		    db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_miembros SET user_baneado = 0 WHERE user_id = \''.$this->uid.'\'');
			db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM u_suspension WHERE user_id = \''.$this->uid.'\'');
            return false;
        } else return $data;
    }
	/*
		getUserID($tsUsername)
	*/
	function getUserID($tsUser){
	global $tsCore;
		//
		$tsUsername = strtolower($tsUser);
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT user_id FROM u_miembros WHERE LOWER(user_name) = \''.$tsCore->setSecure($tsUsername).'\' LIMIT 1');
		$tsUser = db_exec('fetch_assoc', $query);
        
		$tsUserID = $tsUser['user_id'];
		//
		return empty($tsUserID) ? 0 : $tsUserID;
	}
	/*
        getUserName($user_id)
    */
    function getUserName($user_id){
		//
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT user_name FROM u_miembros WHERE user_id = \''.(int)$user_id.'\' LIMIT 1');
		$tsUser = db_exec('fetch_assoc', $query);
        
        //
		return $tsUser['user_name'];
    }
    /**
     * @name iFollow
     * @access public
     * @param int
     * @return void
     */
    public function iFollow($user_id){
        # SIGO A ESTE USUARIO
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT follow_id FROM u_follows WHERE f_id = \''.(int)$user_id.'\' AND f_user = \''.$this->uid.'\' AND f_type = \'1\' LIMIT 1');
		$data = db_exec('num_rows', $query);
		
        //
        return ($data > 0) ? true : false;
    }
    /**
     * @name getVCard
     * @access public
     * @param int
     * @return array
     * @info OBTIENE LA INFORMACION DE UN USUARIO PARA UNA VCARD
     */
    public function getVCard($user_id){
        # GLOBALES
        global $tsCore;
        # LOCALES
        $is_online = (time() - ($tsCore->settings['c_last_active'] * 60));
        $is_inactive = (time() - (($tsCore->settings['c_last_active'] * 60) * 2)); // DOBLE DEL ONLINE
		// INFORMACION GENERAL
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_id, u.user_name, u.user_lastactive, u.user_baneado, p.user_sexo, p.user_pais, p.p_nombre, p.p_mensaje, p.p_sitio FROM u_miembros AS u, u_perfil AS p WHERE u.user_id = \''.(int)$user_id.'\' AND p.user_id = \''.(int)$user_id.'\'');
		$data = db_exec('fetch_assoc', $query);
        
		//  STATS
		$query =  db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_puntos, r.r_name, r.r_color, r.r_image FROM u_miembros AS u LEFT JOIN u_rangos AS r ON u.user_rango = r.rango_id WHERE user_id = \''.(int)$user_id.'\' LIMIT 1');
		$data['stats'] = db_exec('fetch_assoc', $query);
        
		$q1 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(post_id) AS p FROM p_posts WHERE post_user = \''.(int)$user_id.'\' && post_status = \'0\''));;
        $q2 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(cid) AS c FROM p_comentarios WHERE c_user = \''.(int)$user_id.'\' && c_status = \'0\''));;
		$q3 = db_exec('fetch_row', db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(follow_id) AS s FROM u_follows WHERE f_id = \''.(int)$user_id.'\' && f_type = \'1\''));
		 
        $data['stats']['user_posts'] = $q1[0];
        $data['stats']['user_comentarios'] = $q2[0];
        $data['stats']['user_seguidores'] = $q3[0];
        // STATUS
        if($data['user_lastactive'] > $is_online) $data['status'] = array('t' => 'Online', 'css' => 'online');
        elseif($data['user_lastactive'] > $is_inactive) $data['status'] = array('t' => 'Inactivo', 'css' => 'inactive');
        else $data['status'] = array('t' => 'Offline', 'css' => 'offline');
		// SIGUIENDO
        $data['follow'] = $this->iFollow($user_id);
        //
		return $data;
    }
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
							// FUNCIONES EXTERNAS \\
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*
        getUsuarios()
    */
    function getUsuarios(){
        global $tsCore;
        // FILTROS ||
        $is_online = (time() - ($tsCore->settings['c_last_active'] * 60));
        $is_inactive = (time() - (($tsCore->settings['c_last_active'] * 60) * 2)); // DOBLE DEL ONLINE
        // ONLINE?
        if($_GET['online'] == 'true'){
            $w_online = 'AND u.user_lastactive > '.$is_online.'';
        }
        // CON FOTO
        if($_GET['avatar'] == 'true'){
            $w_avatar = 'AND p.p_avatar = 1';
        }
        // SEXO
        if(!empty($_GET['sexo'])){
            $sex = ($_GET['sexo'] == 'f') ? 0 : 1;
            $w_sex = '&& p.user_sexo = \''.$sex.'\'';
        }
        // PAIS
        if(!empty($_GET['pais'])){
            $pais = $tsCore->setSecure($_GET['pais']);
            $w_pais = '&& p.user_pais = \''.$pais.'\'';
        }
        // STAFF
        if(!empty($_GET['rango'])){
            $rango = (int)$_GET['rango'];
            $w_rango = '&& u.user_rango = '.$rango.'';
        }
        // TOTAL Y PAGINAS
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT COUNT(u.user_id) AS total FROM u_miembros AS u LEFT JOIN u_perfil AS p ON u.user_id = p.user_id WHERE u.user_activo = \'1\' && u.user_baneado = \'0\' '.$w_online.' '.$w_avatar.' '.$w_sex.' '.$w_pais.' '.$w_rango);
        $total = db_exec('fetch_assoc', $query);
        $total = $total['total'];
        
        $pages = $tsCore->getPagination($total, 12);
        // CONSULTA
        $query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT u.user_id, u.user_name, p.user_pais, p.user_sexo, p.p_avatar, p.p_mensaje, u.user_rango, u.user_puntos, u.user_comentarios, u.user_posts, u.user_lastactive, u.user_baneado, r.r_name, r.r_color, r.r_image FROM u_miembros AS u LEFT JOIN u_perfil AS p ON u.user_id = p.user_id LEFT JOIN u_rangos AS r ON r.rango_id = u.user_rango WHERE u.user_activo = \'1\' && u.user_baneado = \'0\' '.$w_online.' '.$w_avatar.' '.$w_sex.' '.$w_pais.' '.$w_rango.'  ORDER BY u.user_id DESC LIMIT '.$pages['limit']);
        // PARA ASIGNAR SI ESTA ONLINE HACEMOS LO SIGUIENTE
        while($row = db_exec('fetch_assoc', $query)){
            if($row['user_lastactive'] > $is_online) $row['status'] = array('t' => 'Online', 'css' => 'online');
            elseif($row['user_lastactive'] > $is_inactive) $row['status'] = array('t' => 'Inactivo', 'css' => 'inactive');
            else $row['status'] = array('t' => 'Offline', 'css' => 'offline');
            // RANGO
    		$row['rango'] = array('title' => $row['r_name'], 'color' => $row['r_color'], 'image' => $row['r_image']);
            // CARGAMOS
            $data[] = $row;
        }
        
        // ACTUALES
        $total = explode(',',$pages['limit']);
        $total = ($total[0]) + count($data);
        //
        return array('data' => $data, 'pages' => $pages, 'total' => $total);
    }
	
	

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
}

// --------------------------------------------------------------------

class tsSession {

    var $ID                 = '';
    var $sess_expiration    = 7200;
    var $sess_match_ip      = FALSE;
    var $sess_time_online   = 300;
    var $cookie_prefix      = 'pp_';
    var $cookie_name        = '';
    var $cookie_path        = '/';
    var $cookie_domain      = '';
    var $userdata;
    var $ip_address;
    var $time_now;
    var $db;

    function __construct()
    {
        global $tsCore;
        // Tiempo
        $this->time_now = time();
        // Obtener el dominio o subdominio para la cookie
        $host = parse_url($tsCore->settings['url']);
        $host = str_replace('www.', '' , strtolower($host['host']));
        // Establecer variables
        $this->cookie_domain = ($host == 'localhost') ? '' : '.' . $host;
        $this->cookie_name = $this->cookie_prefix . substr(md5($host), 0, 6);
        // IP
        $this->ip_address = $tsCore->getIP();
        // Cada que un usuario cambie de IP, requerir nueva session?
        $this->sess_match_ip = empty($tsCore->settings['c_allow_sess_ip']) ? FALSE : TRUE;
        // Cada cuanto actualizar la sesión? && Expires
        $this->sess_time_online = empty($tsCore->settings['c_last_active']) ? $this->sess_time_online : ($tsCore->settings['c_last_active'] * 60);
    }
    /**
     * Leer session activa
     *
	 * @access	public
	 * @return	bool
	 */
     function read()
     {
        $this->ID = $_COOKIE[$this->cookie_name . '_sid'];

        // Es un ID válido?
        if(!$this->ID || strlen($this->ID) != 32)
        {
            return FALSE;
        }

        // ** Obtener session desde la base de datos
		$query = db_exec(array(__FILE__, __LINE__), 'query', 'SELECT * FROM u_sessions WHERE session_id = \''.$this->ID.'\'');
        $session = db_exec('fetch_assoc', $query);

        // Existe en la DB?
        if(!isset($session['session_id']))
        {
            $this->destroy();
            return FALSE;
        }

        // Is the session current?
		if (($session['session_time'] + $this->sess_expiration) < $this->time_now AND empty($session['session_autologin']))
		{
			$this->destroy();
			return FALSE;
		}

        // Si cambió de IP creamos una nueva session
        if($this->sess_match_ip == TRUE && $session['session_ip'] != $this->ip_address)
        {
            $this->destroy();
            return FALSE;
        }

        // Listo guardamos y retornamos
        $this->userdata = $session;
        unset($session);

        return TRUE;
     }
	/**
	 * Create a new session
	 *
	 * @access	public
	 * @return	void
	 */
	function create()
	{
        // Generar ID de sesión
        $this->ID = $this->gen_session_id();

        // Guardar en la base de datos, session_user_id siemrpe será 0 aquí
        // si inicia sesión se "actualiza"
		db_exec(array(__FILE__, __LINE__), 'query', 'INSERT INTO u_sessions (session_id, session_user_id, session_ip, session_time) VALUES (\''.$this->ID.'\', \'0\', \''.$this->ip_address.'\', \''.$this->time_now.'\') ');

        // Establecemos la cookie
        $this->set_cookie('sid', $this->ID, $this->sess_expiration);
    }

	/**
	 * Update an existing session
	 *
	 * @access	public
	 * @return	void
	 */
	function update($user_id = 0, $autologin = FALSE, $force_update = FALSE)
	{
	   // Actualizar la sesión cada x tiempo, esto es configurado en el panel de Admin
       if(($this->userdata['session_time'] + $this->sess_time_online) >= $this->time_now AND $force_update == FALSE)
       {
            return;
       }

       // Datos para actualizar
       $this->userdata['session_user_id'] = empty($user_id) ? $this->userdata['session_user_id'] : $user_id;
       $this->userdata['session_ip'] = $this->ip_address;
       $this->userdata['session_time'] = $this->time_now;
       // Autologin requiere una comprovación doble
       $autologin = ($autologin == FALSE) ? 0 : 1;
       $this->userdata['session_autologin'] = empty($this->userdata['session_autologin']) ? $autologin : $this->userdata['session_autologin'];

       // Actualizar en la DB
	   
	   db_exec(array(__FILE__, __LINE__), 'query', 'UPDATE u_sessions SET session_user_id = \''.$this->userdata['session_user_id'].'\', session_ip = \''.$this->userdata['session_ip'].'\', session_time = \''.$this->userdata['session_time'].'\', session_autologin = \''.$this->userdata['session_autologin'].'\' WHERE session_id = \''.$this->ID.'\'');

       // Limpiar sesiones
       $this->sess_gc();

       // Actualizar cookie
       if(!empty($this->userdata['session_autologin']))
       {
            // Si el usuario quiere recordar su sesión, se guardará por 1 año
            $expiration = 31500000;
       }
       else $expiration = $this->sess_expiration;
       //
       $this->set_cookie('sid', $this->ID, $expiration);
    }

	/**
	 * Destroy the current session
	 *
	 * @access	public
	 * @return	void
	 */
	function destroy()
	{
	   // Elminar de la DB
       db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM u_sessions WHERE session_id = \''.$this->ID.'\'');
	   // Reset a la cookie
       $this->set_cookie('sid', '', -31500000);
    }
    /**
     * Crear cookie
     * @access public
     * @param string
     * @param string
     * @param int
     */
	function set_cookie($name, $cookiedata, $cookietime)
	{
        $cookiename = rawurlencode($this->cookie_name . '_' . $name);
        $cookiedata = rawurlencode($cookiedata);
		// Establecer la cookie
        setcookie($cookiename, $cookiedata, ($this->time_now + $cookietime), '/', $this->cookie_domain);
	}
    /**
     * Generar un ID de sesión
     *
     * @access public
     * @param void
     */
    function gen_session_id()
    {
		$sessid = '';
		while (strlen($sessid) < 32)
		{
			$sessid .= mt_rand(0, mt_getrandmax());
		}

		// To make the session ID even more secure we'll combine it with the user's IP
		$sessid .= $this->ip_address;

        return md5(uniqid($sessid, TRUE));
    }
	/**
	 * Eliminar sesiones expiradas
	 *
	 * @access	public
	 * @return	void
	 */
	function sess_gc()
	{
        // Esto es para no eliminar con cada llamada a esta función
        // sólo si se cumple la siguiente sentencia se eliminan las sesiones
		if ((rand() % 100) < 30)
		{
            // Usuario sin actividad
    		$expire = $this->time_now - $this->sess_time_online;
            
			db_exec(array(__FILE__, __LINE__), 'query', 'DELETE FROM u_sessions WHERE session_time < '.$expire.' AND session_autologin = \'0\'');
        }
	}
}